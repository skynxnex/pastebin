<?php
if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Paste extends CI_Controller {

  function __construct() {
    parent::__construct();
    $this->load->model('paste_model');
    require_once 'application/geshi/geshi.php';
    require_once "Mail.php";
  }

  function index() {
    if (loggedin()) {
      $data['body'] = 'main';
      $data['encodings'] = $this->doctrine->em->getRepository('Entities\Encoding')->findAll();
      $this->load->view('template', $data);
    } else {
      $this->load->view('login');
    }
  }

  public function sendMail() {
    $this->load->library('email');
    $settings = array(
      'smtp_host' => 'send.one.com',
      'smtp_user' => 'info@almar.se',
      'smtp_pass' => 'fukten',
      'smtp_port' => 2525,
      'protocol' => 'smtp'
    );
    $this->email->initialize($settings);

    $this->email->from('info@almar.se', 'Admin');
    $this->email->to('pontus@almar.se');

    $this->email->subject('Email Test');
    $this->email->message('Testing the email class.');

    $this->email->send();

    echo $this->email->print_debugger();
    // $from = "Sandra Sender <sender@example.com>";
    // $to = "Pontus Alm <pontus@almar.se>";
    // $subject = "Hi!";
    // $body = "Hi,\n\nHow are you?";
    //
    // $host = "send.one.com";
    // $username = "pontus@almar.se";
    // $password = "fukten";
    //
    // $headers = array (	'From' => $from,
    // 'To' => $to,
    // 'Subject' => $subject);
    // $smtp = Mail::factory('smtp',
    // array (	'host' => $host,
    // 'auth' => true,
    // 'username' => $username,
    // 'password' => $password)
    // );
    //
    // $mail = $smtp->send($to, $headers, $body);
    //
    // if (PEAR::isError($mail)) {
    // echo("<p>" . $mail->getMessage() . "</p>");
    // } else {
    // echo("<p>Message successfully sent!</p>");
    // }
  }

  public function top() {
    if (loggedin()) {
        $data['pastes'] = $this->doctrine->em->getRepository('Entities\Snippet')->findBy(array('visibility' => 1), array('viewed' => 'DESC'),10);
        $data['body'] = 'top_pastes';
        $this->load->view('template', $data);
    } else {
      $this->load->view('login');
    }
  }

  public function raw() {
    $result = $this->paste_model->getRaw();
    if ($result->visibility) {
      $geshi = new GeSHi($result->paste, $result->type);
      $result->paste = $geshi->parse_code();
      $data['paste'] = $result;
      $this->load->view('raw', $data);

    } else {
      $data['paste']['paste'] = 'Not a public paste!';
      $this->load->view('raw', $data);
    }
  }

  public function mark() {
    if (loggedin()) {
      if ($this->session->userdata('admin')) {
        $result = $this->paste_model->mark();
        if ($result) {
          redirect(base_url() . 'paste/reports', 'refresh');
        } else {
          $data['body'] = 'error';
          $data['mess'] = "Something went wrong when trying to change to viewed!";
          $this->load->view('template', $data);
        }
      } else {
        $data['body'] = 'error';
        $data['mess'] = "You don't have permission to access this page!";
        $this->load->view('template', $data);
      }
    } else {
      $this->load->view('login');
    }
  }

  public function reports() {
    if (loggedin()) {
      if ($this->session->userdata('admin')) {
        $result = $this->paste_model->getReports();
        if ($result) {
          $ppage = 15;
          $start = 0;

          $config['uri_segment'] = 3;
          $config['num_links'] = 8;
          $config['base_url'] = base_url() . 'paste/reports/';
          $config['total_rows'] = count($result);
          $config['per_page'] = $ppage;

          $config['full_tag_open'] = '<div class="pagination"><ul>';
          $config['full_tag_close'] = '</div></ul>';

          $config['next_tag_open'] = '<li>';
          $config['next_tag_close'] = '</li>';

          $config['num_tag_open'] = '<li>';
          $config['num_tag_close'] = '</li>';

          $config['cur_tag_open'] = '<li class="active"><a>';
          $config['cur_tag_close'] = '</a></li>';
          $config['last_link'] = 'Last';
          $config['first_link'] = 'First';

          $this->pagination->initialize($config);
          if ($this->uri->segment(3) != '') {
            $start = $this->uri->segment(3);
          }
          $data['pages'] = $this->pagination->create_links();

          $data['reports'] = $this->paste_model->getReports($start, $ppage);
          $data['body'] = 'reports';
          $this->load->view('template', $data);

        } else {
          $data['body'] = 'error';
          $data['mess'] = "No reports to show!";
          $this->load->view('template', $data);
        }
      } else {
        $data['body'] = 'error';
        $data['mess'] = "You don't have permission to view this page!";
        $this->load->view('template', $data);
      }
    } else {
      $this->load->view('login');
    }
  }

  public function delete() {
    if ($this->session->userdata('admin')) {
      if ($this->input->post()) {
        $result = $this->paste_model->delete();
        if ($result) {
          $mess[] = array(
            'message' => 'The paste was removed.',
            'type' => '',
            'heading' => 'Sucess!'
          );
          $data['encodings'] = $this->paste_model->getEncodings();
          $this->session->set_userdata('messages', $mess);
          $data['body'] = 'main';
          $this->load->view('template', $data);
        } else {
          $data['body'] = 'error';
          $this->load->view('template', $data);
        }
      } else {
        $data['url'] = $this->uri->segment(3);
        $data['body'] = 'confirm';
        $this->load->view('template', $data);
      }
    } elseif (loggedin()) {
      $data['body'] = 'error';
      $this->load->view('template', $data);
    } else {
      $this->load->view('login');
    }
  }

  public function report() {
    if (loggedin()) {
      if ($this->input->post()) {
        $result = $this->paste_model->report();
        if ($result) {
          $data['body'] = 'success';
          $this->load->view('template', $data);
        } else {
          $data['body'] = 'error';
          $this->load->view('template', $data);
        }
      } else {
        $data['body'] = 'report';
        $this->load->view('template', $data);
      }
    } else {
      $this->load->view('login');
    }
  }

  public function search() {
    if (loggedin()) {
      $search = $this->input->post('search');
      $result = $this->doctrine->em->getRepository('Entities\Snippet')->createQueryBuilder('o')
                 ->where('o.snippet LIKE :search')
                 ->orWhere('o.headline LIKE :search')
                 ->setParameter('search', '%' . $search . '%')
                 ->setMaxResults(10)
                 ->getQuery()
                 ->getResult();
      $data['pastes'] = $result;
      $data['body'] = 'search';
      $this->load->view('template', $data);
    } else {
      $this->load->view('login');
    }
  }

  public function my() {
    if (loggedin()) {
      $user = $this->doctrine->em->getRepository('Entities\User')->findOneBy(array('id' => $this->session->userdata('id')));
      $total_rows = count($this->doctrine->em->getRepository('Entities\Snippet')->findBy(array('user' => $user->getId())));
      $ppage = 2;
      $start = 0;

      $config['uri_segment'] = 3;
      $config['num_links'] = 8;
      $config['base_url'] = base_url() . 'paste/my/';
      $config['total_rows'] = $total_rows;
      $config['per_page'] = $ppage;

      $config['full_tag_open'] = '<div class="pagination"><ul>';
      $config['full_tag_close'] = '</div></ul>';

      $config['next_tag_open'] = '<li>';
      $config['next_tag_close'] = '</li>';

      $config['num_tag_open'] = '<li>';
      $config['num_tag_close'] = '</li>';

      $config['cur_tag_open'] = '<li class="active"><a>';
      $config['cur_tag_close'] = '</a></li>';
      $config['last_link'] = 'Last';
      $config['first_link'] = 'First';

      $this->pagination->initialize($config);
      if ($this->uri->segment(3) != '') {
        $start = $this->uri->segment(3);
      }
      $data['pages'] = $this->pagination->create_links();

      $data['body'] = 'list';
      $data['pastes'] = $this->doctrine->em->getRepository('Entities\Snippet')->findBy(array('user' => $user->getId()), array('date' => 'DESC'), $ppage, $start);
      $this->load->view('template', $data);
    } else {
      $this->load->view('login');
    }
  }

  function create() {
    if (loggedin()) {
      $this->form_validation->set_error_delimiters('<div class="alert alert-error">', '</div>');
      $this->form_validation->set_rules('headline', 'Headline', 'required');
      $this->form_validation->set_rules('paste', 'Paste', 'required');
      if ($this->form_validation->run() == FALSE) {
        $data['body'] = 'main';
        $data['encodings'] = $this->doctrine->em->getRepository('Entities\Encoding')->findAll();
        $this->load->view('template', $data);
      } else {
        $snippet = new Entities\Snippet;
        $snippet->setHeadline($this->input->post('headline'));
        $snippet->setSnippet($this->input->post('paste'));
        $snippet->setDeleted(0);
        $snippet->setViewed(0);
        $snippet->setDate(new \DateTime("now"));
        $visibility = $this->input->post('visibility') == 'public' ? 1 : 0;
        $snippet->setVisibility($visibility);
        $user = $this->doctrine->em->getRepository('Entities\User')->findOneBy(array('id' => $this->session->userdata('id')));
        $encoding = $this->doctrine->em->getRepository('Entities\Encoding')->findOneBy(array('id' => $this->input->post('encoding')));
        $snippet->setEncoding($encoding);
        $snippet->setUser($user);
        $this->doctrine->em->persist($snippet);
        $this->doctrine->em->flush();
        $data['body'] = 'success';
        $this->load->view('template', $data);
      }
    } else {
      $this->load->view('login');
    }
  }

  public function show() {
    if (loggedin()) {
      $data = array();
      $snippet = $this->doctrine->em->getRepository('Entities\Snippet')->findOneBy(array('id' => $this->uri->segment(3)));
      if ($snippet) {
        $type = $snippet->getEncoding()->getType();
        $snippet->setViewed($snippet->getViewed() +1);
        $this->doctrine->em->persist($snippet);
        $this->doctrine->em->flush();
        if ($type != 'text') {
          $geshi = new GeSHi($snippet->getSnippet(), $snippet->getEncoding()->getType());
          $geshi->enable_line_numbers(GESHI_FANCY_LINE_NUMBERS);
          $snippet->setSnippet($geshi->parse_code());
        }
        $data['body'] = 'show';
        $data['paste'] = $snippet;
        $this->load->view('template', $data);
      } else {
        $data['body'] = 'error';
        $data['mess'] = "This paste does not exist!";
        $this->load->view('template', $data);
      }
    } else {
      if ($this->uri->segment(3)) {
        $snippet = $this->doctrine->em->getRepository('Entities\Snippet')->findOneBy(array('id' => $this->uri->segment(3)));
        if ($snippet) {
          $type = $snippet->getEncoding()->getType();
          $snippet->setViewed($snippet->getViewed() +1);
          $this->doctrine->em->persist($snippet);
          $this->doctrine->em->flush();
          if ($type != 'text') {
            $geshi = new GeSHi($snippet->getSnippet(), $snippet->getEncoding()->getType());
            $geshi->enable_line_numbers(GESHI_FANCY_LINE_NUMBERS);
            $snippet->setSnippet($geshi->parse_code());
          }
          if ($snippet->getVisibility()) {
            $data['error'] = 0;
            $data['paste'] = $snippet;
            $this->load->view('guest', $data);
          } else {
            $this->load->view('private');
          }
        } else {
          $data['error'] = 1;
          $data['body'] = 'error';
          $data['mess'] = "This paste does not exist!";
          $this->load->view('guest', $data);
        }
      } else {
        $this->load->view('login');
      }
    }
  }

  public function edit() {
    if (loggedin()) {
      if ($this->input->post()) {
        $this->form_validation->set_error_delimiters('<div class="alert alert-error">', '</div>');
        $this->form_validation->set_rules('headline', 'Headline', 'required');
        $this->form_validation->set_rules('paste', 'Paste', 'required');
        if ($this->form_validation->run() == FALSE) {
          $snippet = $this->doctrine->em->getRepository('Entities\Snippet')->findOneBy(array('id' => $this->uri->segment(3)));
          if ($snippet->getUser()->getId() == $this->session->userdata('id')) {
            $data['paste'] = $snippet;
            $data['encodings'] = $this->doctrine->em->getRepository('Entities\Encoding')->findAll();
            $data['body'] = 'edit';
            $this->load->view('template', $data);
          } else {
            $data['body'] = 'error';
            $this->load->view('template', $data);
          }
        } else {
          $snippet = $this->doctrine->em->getRepository('Entities\Snippet')->findOneBy(array('id' => $this->uri->segment(3)));
          
          $snippet->setHeadline($this->input->post('headline'));
          $snippet->setSnippet($this->input->post('paste'));
          $visibility = $this->input->post('visibility') == 'public' ? 1 : 0;
          $snippet->setVisibility($visibility);
          $encoding = $this->doctrine->em->getRepository('Entities\Encoding')
                        ->findOneBy(array('type' => $this->input->post('encoding')));
          $snippet->setEncoding($encoding);
          $this->doctrine->em->persist($snippet);
          $this->doctrine->em->flush();
          $mess[] = array(
            'message' => 'The snippet was edited.',
            'type' => '',
            'heading' => 'Sucess!'
          );
          $this->session->set_userdata('messages', $mess);
          redirect('/paste/show/' . $this->uri->segment(3), 'refresh');
        }
      } else {
        $snippet = $this->doctrine->em->getRepository('Entities\Snippet')->findOneBy(array('id' => $this->uri->segment(3)));
        if ($snippet->getUser()->getId() == $this->session->userdata('id')) {
          $data['paste'] = $snippet;
          $data['encodings'] = $this->doctrine->em->getRepository('Entities\Encoding')->findAll();
          $data['body'] = 'edit';
          $this->load->view('template', $data);
        } else {
          $data['body'] = 'error';
          $this->load->view('template', $data);
        }
      }
    } else {
      $this->load->view('login');
    }
  }

  public function populateDatabase() {
    $encodings = array(
      'php' => 'PHP',
      'css' => 'CSS',
      'html' => 'HTML',
      'javascript' => 'Javascript',
      'python' => 'Python',
      'text' => 'Text'
    );
    foreach($encodings as $key => $value) {
      $encoding = new Entities\Encoding;
      $encoding->setName($value);
      $encoding->setType($key);
      $this->doctrine->em->persist($encoding);
    }
    $this->doctrine->em->flush();
  }

}

/* End of file paste.php */
/* Location: ./application/controllers/pastebin.php */
