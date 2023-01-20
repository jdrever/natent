<?php
return function($kirby, $site, $pages, $page) {

    $alert = null;

   

    if($kirby->request()->is('POST')) 
    {
        $platformPage=site()->find('platform');

        $language=$kirby->language()->code();
        $languagePage=$platformPage->children()->filterBy('template','country')->filterBy('language','*=', $language)->first();

        $toAddress=$languagePage->emailAddress()->isNotEmpty() ? $languagePage->emailAddress() : 'james@careful.digital';


        // check the honeypot
        if(empty(get('website')) === false) {
            go($page->url());
            exit;
        }

        $data = [
            'name' => get('name'),
            'email' => get('email'),
            'message'  => get('message')
        ];

        $rules = [
            'name'  => ['required', 'minLength' => 3],
            'email' => ['required', 'email'],
            'message'  => ['required', 'minLength' => 3, 'maxLength' => 3000],
        ];

        $messages = [
            'name'  => 'Please enter a valid name',
            'email' => 'Please enter a valid email address',
            'message'  => 'Please enter a message'
        ];

        // some of the data is invalid
        if($invalid = invalid($data, $rules, $messages)) {
            $alert = $invalid;

            // the data is fine, let's send the email
        } else {
            try {
                $kirby->email([
                    'template' => 'email',
                    'from'     => 'james@careful.digital',
                    'replyTo'  => $data['email'],
                    'to'       => $toAddress,
                    'cc'       => 'james@careful.digital',
                    'subject'  => esc($data['name']) . ' sent you a message from the NatEnt Platform',
                    'data'     => [
                        'text'   => esc($data['message']),
                        'sender' => esc($data['name']),
                        'email'  => esc($data['email'])
                    ]
                ]);

            } catch (Exception $error) {
                if(option('debug')):
                    $alert['error'] = 'The form could not be sent: <strong>' . $error->getMessage() . '</strong>';
                else:
                    $alert['error'] = 'The form could not be sent!';
                endif;
            }

            // no exception occurred, let's send a success message
            if (empty($alert) === true) {
                $success = 'Your message has been sent, thank you. We will get back to you soon!';
                $data = [];
            }
        }
    }

    return [
        'alert'   => $alert,
        'data'    => $data ?? false,
        'success' => $success ?? false
    ];
};