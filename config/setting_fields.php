<?php

return [
    'app' => [
        'title' => 'General',
        'desc'  => 'All the general settings for application.',
        'icon'  => 'fas fa-cube',
        'elements' => [
            [
                'type'  => 'text', // input fields type
                'data'  => 'string', // data type, string, int, boolean
                'name'  => 'app_name', // unique name for field
                'label' => 'App Name', // you know what label it is
                'rules' => 'required|min:2|max:50', // validation rule of laravel
                'class' => '', // any class for input
                'value' => 'PT. Anandita - Catering dan Rental', // default value if you want
            ],
            [
                'type'  => 'text', // input fields type
                'data'  => 'string', // data type, string, int, boolean
                'name'  => 'footer_text', // unique name for field
                'label' => 'Footer Text', // you know what label it is
                'rules' => 'required|min:2', // validation rule of laravel
                'class' => '', // any class for input
                'value' => 'PT. Anandita', // default value if you want
            ],
            [
                'type'  => 'email', // input fields type
                'data'  => 'string', // data type, string, int, boolean
                'name'  => 'email', // unique name for field
                'label' => 'Email', // you know what label it is
                'rules' => 'required|email', // validation rule of laravel
                'class' => '', // any class for input
                'value' => 'yulinasari133@yahoo.com', // default value if you want
            ],
            [
                'type'  => 'text', // input fields type
                'data'  => 'string', // data type, string, int, boolean
                'name'  => 'phone_number', // unique name for field
                'label' => 'Phone Number', // you know what label it is
                'rules' => 'required', // validation rule of laravel
                'class' => '', // any class for input
                'value' => '085250606606', // default value if you want
            ],
            [
                'type'  => 'text', // input fields type
                'data'  => 'string', // data type, string, int, boolean
                'name'  => 'address', // unique name for field
                'label' => 'Alamat', // you know what label it is
                'rules' => 'required', // validation rule of laravel
                'class' => '', // any class for input
                'value' => 'Desa Bakungan RT. 15, Kecamatan Loa Janan, Kabupaten Kutaikartanegara, Kalimantan Timur', // default value if you want
            ],
            [
                'type'  => 'text', // input fields type
                'data'  => 'string', // data type, string, int, boolean
                'name'  => 'maps', // unique name for field
                'label' => 'Google Map', // you know what label it is
                'rules' => 'required', // validation rule of laravel
                'class' => '', // any class for input
                'value' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.6032078903304!2d117.0442083147534!3d-0.5949709995659305!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMMKwMzUnNDEuOSJTIDExN8KwMDInNDcuMCJF!5e0!3m2!1sid!2sid!4v1634047154558!5m2!1sid!2sid', // default value if you want
            ],
            [
                'type'  => 'file', // input fields type
                'data'  => 'string', // data type, string, int, boolean
                'name'  => 'logo', // unique name for field
                'label' => 'Logo', // you know what label it is
                'rules' => 'required', // validation rule of laravel
                'class' => '', // any class for input
                'value' => 'storage/files/logo/logo-horizontal.png', // default value if you want
            ],
            [
                'type'  => 'file', // input fields type
                'data'  => 'string', // data type, string, int, boolean
                'name'  => 'favicon', // unique name for field
                'label' => 'Favicon', // you know what label it is
                'rules' => 'required', // validation rule of laravel
                'class' => '', // any class for input
                'value' => 'storage/files/logo/favicon.png', // default value if you want
            ],

        ],
    ],
    'about' => [
        'title' => 'Tentang',
        'desc'  => 'Bagian Tentang di Halaman Depan',
        'icon'  => 'fas fa-home',

        'elements' => [
            [
                'type'  => 'text', // input fields type
                'data'  => 'string', // data type, string, int, boolean
                'name'  => 'about_header', // unique name for field
                'label' => 'Judul Tentang', // you know what label it is
                'rules' => 'required|nullable|max:191', // validation rule of laravel
                'class' => '', // any class for input
                'value' => 'Kami menyediakan Catering dan Rental.', // default value if you want
            ],
            [
                'type'  => 'editor', // input fields type
                'data'  => 'string', // data type, string, int, boolean
                'name'  => 'about_description', // unique name for field
                'label' => 'Deskripsi Tentang', // you know what label it is
                'rules' => 'required|nullable|max:191', // validation rule of laravel
                'class' => '', // any class for input
                'value' => 'Pendirian Commanditaire Vennotschap / Persekutuan Komanditer (PT) PT.ANANDITA didirkan pada tanggal 19 November 2014 Berdasarkan Akte Persekutuan Komanditer Terbatas Nomor TDP 17.0.6.3.49.07060 Tahun 2014 oleh TRIWANLI,SH,.M.Kn. yang dibuat di Tenggarong', // default value if you want
            ],
            [
                'type'  => 'file', // input fields type
                'data'  => 'string', // data type, string, int, boolean
                'name'  => 'about_image', // unique name for field
                'label' => 'Gambar', // you know what label it is
                'rules' => 'required|nullable|max:191', // validation rule of laravel
                'class' => '', // any class for input
                'value' => 'storage/files/logo/header.svg', // default value if you want
            ],
            [
                'type'  => 'file', // input fields type
                'data'  => 'string', // data type, string, int, boolean
                'name'  => 'about_resume', // unique name for field
                'label' => 'Resume', // you know what label it is
                'rules' => 'required|nullable|max:191', // validation rule of laravel
                'class' => '', // any class for input
                'value' => '/images/header.svg', // default value if you want
            ],
        ],
    ],
    'experience' => [
        'title' => 'Experience',
        'desc'  => 'Bagian Experience di Halaman Depan',
        'icon'  => 'fas fa-user-tie',
        'elements' => [
            [
                'type'  => 'editor', // input fields type
                'data'  => 'string', // data type, string, int, boolean
                'name'  => 'experience_description', // unique name for field
                'label' => 'Deskripsi Experience', // you know what label it is
                'rules' => 'required|nullable|max:191', // validation rule of laravel
                'class' => '', // any class for input
                'value' => 'PT. ANANDITA telah berpengalaman di bidang catering selama 10 tahun dan rental selama 9 tahun, dengan pengalaman tersebut PT. ANANDITA telah berkejasama dengan beberapa perusahaan.', // default value if you want
            ],
        ],
    ],
    'contact' => [
        'title' => 'Kontak',
        'desc'  => 'Bagian Kontak di Halaman Depan',
        'icon'  => 'fas fa-phone',
        'elements' => [
            [
                'type'  => 'text', // input fields type
                'data'  => 'string', // data type, string, int, boolean
                'name'  => 'contact_title', // unique name for field
                'label' => 'Judul Kontak', // you know what label it is
                'rules' => 'required|nullable|max:191', // validation rule of laravel
                'class' => '', // any class for input
                'value' => 'Tertarik bekerja sama? Hubungi kami!', // default value if you want
            ],
        ],
    ],
    'meta' => [
        'title' => 'Meta ',
        'desc'  => 'Application Meta Data',
        'icon'  => 'fas fa-globe-asia',

        'elements' => [
            [
                'type'  => 'text', // input fields type
                'data'  => 'text', // data type, string, int, boolean
                'name'  => 'meta_site_name', // unique name for field
                'label' => 'Meta Site Name', // you know what label it is
                'rules' => 'required', // validation rule of laravel
                'class' => '', // any class for input
                'value' => 'Perumdam Tirta Kencana Kota Samarinda', // default value if you want
            ],
            [
                'type'  => 'text', // input fields type
                'data'  => 'text', // data type, string, int, boolean
                'name'  => 'meta_description', // unique name for field
                'label' => 'Meta Description', // you know what label it is
                'rules' => 'required', // validation rule of laravel
                'class' => '', // any class for input
                'value' => 'Perumdam Tirta Kencana Kota Samarinda.', // default value if you want
            ],
            [
                'type'  => 'text', // input fields type
                'data'  => 'text', // data type, string, int, boolean
                'name'  => 'meta_keyword', // unique name for field
                'label' => 'Meta Keyword', // you know what label it is
                'rules' => 'required', // validation rule of laravel
                'class' => '', // any class for input
                'value' => 'Web Application, Laravel,Laravel starter,Bootstrap,Admin,Template,Open,Source, nasir khan, nasirkhan', // default value if you want
            ],
            [
                'type'  => 'text', // input fields type
                'data'  => 'text', // data type, string, int, boolean
                'name'  => 'meta_image', // unique name for field
                'label' => 'Meta Image', // you know what label it is
                'rules' => 'required', // validation rule of laravel
                'class' => '', // any class for input
                'value' => 'img/default_banner.jpg', // default value if you want
            ],
            [
                'type'  => 'text', // input fields type
                'data'  => 'text', // data type, string, int, boolean
                'name'  => 'meta_fb_app_id', // unique name for field
                'label' => 'Meta Facebook App Id', // you know what label it is
                'rules' => '', // validation rule of laravel
                'class' => '', // any class for input
                'value' => '569561286532601', // default value if you want
            ],
            [
                'type'  => 'text', // input fields type
                'data'  => 'text', // data type, string, int, boolean
                'name'  => 'meta_twitter_site', // unique name for field
                'label' => 'Meta Twitter Site Account', // you know what label it is
                'rules' => '', // validation rule of laravel
                'class' => '', // any class for input
                'value' => '@nasir8891', // default value if you want
            ],
            [
                'type'  => 'text', // input fields type
                'data'  => 'text', // data type, string, int, boolean
                'name'  => 'meta_twitter_creator', // unique name for field
                'label' => 'Meta Twitter Creator Account', // you know what label it is
                'rules' => '', // validation rule of laravel
                'class' => '', // any class for input
                'value' => '@nasir8891', // default value if you want
            ],
        ],
    ],
    'analytics' => [
        'title' => 'Analytics',
        'desc'  => 'Application Analytics',
        'icon'  => 'fas fa-chart-line',

        'elements' => [
            [
                'type'  => 'text', // input fields type
                'data'  => 'string', // data type, string, int, boolean
                'name'  => 'google_analytics', // unique name for field
                'label' => 'Google Analytics', // you know what label it is
                'rules' => '', // validation rule of laravel
                'class' => '', // any class for input
                'value' => 'UA-36770598-2', // default value if you want
            ],
        ],

    ],
];
