<?php

return [
    'adminEmail' => 'admin@example.com',
    //'onlineapp_api' => YII_DEBUG ? 'http://localhost:81/onlineapplication/api' : 'https://application.uonbi.ac.ke/api',
    'onlineapp_api' => 'https://application.uonbi.ac.ke/api',
    'api_user' => 'API_USER',
    'api_token' => 'andalite6',

    // ROLES PER MENU ACCESS & ACTIONS
    'ac_roles'=>[ // Access Control Roles
        'student' => ['VC_ROLE','COLLEGE_PRINCIPAL','DVC_AA_ROLE','REGISTRAR_PLANNING_ROLE','REGISTRAR_ACADEMIC_ROLE','GRADUATE_SCHOOL_ROLE',],
        'finance' =>  ['VC_ROLE','COLLEGE_PRINCIPAL','DVC_AF_ROLE','REGISTRAR_PLANNING_ROLE','FINANCE_OFFICER_ROLE',],
        'hr' =>   ['VC_ROLE','COLLEGE_PRINCIPAL','DVC_AF_ROLE',],
        'web' =>  ['VC_ROLE','COLLEGE_PRINCIPAL','DVC_AF_ROLE','DVC_RPE_ROLE','DVC_AA_ROLE','REGISTRAR_PLANNING_ROLE','REGISTRAR_ACADEMIC_ROLE','GRADUATE_SCHOOL_ROLE',],
        'research' =>  ['VC_ROLE','COLLEGE_PRINCIPAL','DVC_RPE_ROLE','REGISTRAR_PLANNING_ROLE',],
        'admin' =>  ['VC_ROLE','COLLEGE_PRINCIPAL','DVC_AF_ROLE','DVC_RPE_ROLE','REGISTRAR_PLANNING_ROLE',],
        'principal' =>  ['COLLEGE_PRINCIPAL',],
        'hod' =>  ['HOD_ROLE',],
    ],
];
