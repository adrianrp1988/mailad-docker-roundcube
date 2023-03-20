<?php
$config['username_domain'] = getenv('ROUNDCUBEMAIL_USERNAME_DOMAIN');
$config['imap_conn_options'] = array(
    'ssl' => [
         'verify_peer'       => true,
         'allow_self_signed' => true,
//         'peer_name'         =>  'xyz.mailad.cu',
         'verify_peer_name' => false,
    ],
    );

    $config['smtp_conn_options'] = array(
      'ssl'=> array(
          'verify_peer'      => true,
//          'peer_name'        =>  'xyz.mailad.cu',
          'allow_self_signed'=> true,
          'verify_peer_name' => false,
      ),
    );

// Samba AD DC Address Book
$config['autocomplete_addressbooks'] = array('global_ldap_book');
if ((getenv('ROUNDCUBE_AUTOCOMPLETE_ADDRESS_BOOK_HOST')!== false) &&
    (getenv('ROUNDCUBE_AUTOCOMPLETE_ADDRESS_BOOK_BASE_DN')!== false) &&
    (getenv('ROUNDCUBE_AUTOCOMPLETE_ADDRESS_BOOK_BIND_DN')!== false) &&
    (getenv('ROUNDCUBE_AUTOCOMPLETE_ADDRESS_BOOK_BIND_PASS')!== false)){
    $config['ldap_public']["global_ldap_book"] = array(
        'name'              => 'Mailboxes',
        'hosts'             => array(getenv('ROUNDCUBE_AUTOCOMPLETE_ADDRESS_BOOK_HOST')),
        'port'              => 389,
        'use_tls'           => false,
        'ldap_version'      => '3',
        'network_timeout'   => 10,
        'user_specific'     => false,
        'base_dn'       => getenv('ROUNDCUBE_AUTOCOMPLETE_ADDRESS_BOOK_BASE_DN'),
        'bind_dn'       => getenv('ROUNDCUBE_AUTOCOMPLETE_ADDRESS_BOOK_BIND_DN'),
        'bind_pass'     => getenv('ROUNDCUBE_AUTOCOMPLETE_ADDRESS_BOOK_BIND_PASS'),
        'writable'      => false,
        'search_fields' => array(
            'cn',
            'userPrincipalName',
        ),
        'fieldmap' => array(
            'name'          => 'cn',
            'surname'       => 'sn',
            'firstname'     => 'givenName',
            'title'         => 'title',
            'email'         => 'userPrincipalName:*',
            'phone:work'    => 'telephoneNumber',
            'phone:mobile'  => 'mobile',
            'phone:workfax' => 'facsimileTelephoneNumber',
            'street'        => 'street',
            'zipcode'       => 'postalCode',
            'locality'      => 'l',
            'department'    => 'department',
            'notes'         => 'description',
            'photo'         => 'jpegPhoto',
        ),
        'sort'          => 'cn',
        'scope'         => 'sub',
        'filter'        => '(&(|(objectclass=person))(!(mail=archive@emaclt.co.cu))(!(userAccountControl:1.2.840.113556.1.4.803:=2)))',
        'fuzzy_search'  => true,
        'vlv'           => false,
        'sizelimit'     => '0',
        'timelimit'     => '0',
        'referrals'     => false,
        'group_filters' => array(
            'departments' => array(
            'name'    => 'Lists',
            'scope'   => 'sub',
            'base_dn' => getenv('ROUNDCUBE_AUTOCOMPLETE_ADDRESS_BOOK_BASE_DN'),
            'filter'  => '(objectClass=group)',
            ),
        ),
    );
}

$config['plugins'] = [
    'archive',
    'zipdownload',
];