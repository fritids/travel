<?php
$config = array(
                'create_user' => array(
                                    array(
                                            'field' => 'name',
                                            'label' => 'Name Surname',
                                            'rules' => 'required|trim|xss_clean|htmlspecialchars|min_length[3]|max_length[50]'
                                         ),
                                    array(
                                            'field' => 'email',
                                            'label' => 'E-mail',
                                            'rules' => 'required|trim|xss_clean|htmlspecialchars|max_length[50]|valid_email'
                                         ),
                                    array(
                                            'field' => 'pass1',
                                            'label' => 'Password',
                                            'rules' => 'required|trim|xss_clean|htmlspecialchars|min_length[6]|max_length[20]|matches[pass2]'
                                         ),
                                    array(
                                            'field' => 'pass2',
                                            'label' => 'Password again',
                                            'rules' => 'required|trim|xss_clean|htmlspecialchars|min_length[6]|max_length[20]'
                                         )
                                    ),
				'update_user' => array(
                                    array(
                                            'field' => 'name',
                                            'label' => 'Name Surname',
                                            'rules' => 'required|trim|xss_clean|htmlspecialchars|min_length[3]|max_length[50]'
                                         ),
                                    array(
                                            'field' => 'email',
                                            'label' => 'E-mail',
                                            'rules' => 'required|trim|xss_clean|htmlspecialchars|max_length[50]|valid_email'
                                         ),
                                    array(
                                            'field' => 'department',
                                            'label' => 'User Type / Department',
                                            'rules' => 'required|trim|xss_clean|htmlspecialchars|numeric'
                                         ),
                                    array(
                                            'field' => 'banned',
                                            'label' => 'Banned',
                                            'rules' => 'trim|xss_clean|htmlspecialchars'
                                         ),
									array(
											'field' => 'user_id',
                                            'label' => 'User ID',
                                            'rules' => 'required|trim|xss_clean|htmlspecialchars|numeric|callback__check_user_id'
										)
                                    ),
                                    
                'login_user' => array(
                                    array(
                                            'field' => 'email',
                                            'label' => 'E-mail',
                                            'rules' => 'required|trim|xss_clean|htmlspecialchars|max_length[50]|valid_email'
                                         ),
                                    array(
                                            'field' => 'password',
                                            'label' => 'Password',
                                            'rules' => 'required|trim|xss_clean|htmlspecialchars|min_length[6]|max_length[20]'
                                         )
                                    ),
                                    
                'create_ticket' => array(
                                    array(
                                            'field' => 'title',
                                            'label' => 'Title',
                                            'rules' => 'required|trim|xss_clean|htmlspecialchars|min_length[3]|max_length[255]'
                                         ),
                                    array(
                                            'field' => 'department',
                                            'label' => 'Department',
                                            'rules' => 'required|trim|xss_clean|htmlspecialchars|callback__check_department_id'
                                         ),
                                    array(
                                            'field' => 'priority',
                                            'label' => 'Priority',
                                            'rules' => 'required|trim|xss_clean|htmlspecialchars|callback__check_priority_id'
                                         ),
                                    array(
                                            'field' => 'message',
                                            'label' => 'Message',
                                            'rules' => 'required|trim|xss_clean|min_length[6]|max_length[2000]'
                                         )
                                    ),    
                'reply' => array(
                                    array(
                                            'field' => 'message',
                                            'label' => 'Message',
                                            'rules' => 'required|trim|xss_clean|min_length[2]|max_length[2000]'
                                         ),
                                    array(
                                            'field' => 'ticket_id',
                                            'label' => 'Ticket ID',
                                            'rules' => 'required|trim|xss_clean|htmlspecialchars|numeric|callback__exists_ticket'
                                         )
                                    ) ,
				'lostpassword' => array(
                                    array(
                                            'field' => 'email',
                                            'label' => 'E-mail',
                                            'rules' => 'required|trim|xss_clean|htmlspecialchars|valid_email'
                                         )
                                    ),
				'create_department' => array(
                                    array(
                                            'field' => 'name',
                                            'label' => 'Department Name',
                                            'rules' => 'required|trim|xss_clean|htmlspecialchars|max_length[50]'
                                         )
                                    ),
				'update_department' => array(
                                    array(
                                            'field' => 'name',
                                            'label' => 'Department Name',
                                            'rules' => 'required|trim|xss_clean|htmlspecialchars|max_length[50]'
                                         ),
									array(
                                            'field' => 'department_id',
                                            'label' => 'Department ID',
                                            'rules' => 'required|trim|xss_clean|htmlspecialchars|numeric|callback__check_department_id'
                                         )
                                    ),
				'change_password' => array(
									array(
                                            'field' => 'currentpass',
                                            'label' => 'Current password',
                                            'rules' => 'required|trim|xss_clean|htmlspecialchars|min_length[6]|max_length[20]'
                                         ),
                                    array(
                                            'field' => 'pass1',
                                            'label' => 'New password',
                                            'rules' => 'required|trim|xss_clean|htmlspecialchars|min_length[6]|max_length[20]|matches[pass2]'
                                         ),
									array(
                                            'field' => 'pass2',
                                            'label' => 'New password again',
                                            'rules' => 'required|trim|xss_clean|htmlspecialchars|min_length[6]|max_length[20]'
                                         )
                                    ),
				'change_email' => array(
									array(
                                            'field' => 'email',
                                            'label' => 'E-mail',
                                            'rules' => 'required|trim|xss_clean|htmlspecialchars|max_length[20]|valid_email'
                                         )
                                    ),
                'upload_settings' => array(
									array(
                                            'field' => 'allowed_extensions',
                                            'label' => 'Allowed Extensions',
                                            'rules' => 'required|trim|xss_clean|htmlspecialchars|max_length[50]'
                                         ),
                                    array(
                                            'field' => 'max_upload_files',
                                            'label' => 'Maximum upload files',
                                            'rules' => 'required|trim|xss_clean|htmlspecialchars|max_length[2]|numeric'
                                         ),
                                    array(
                                            'field' => 'max_upload_file_size',
                                            'label' => 'Maximum upload file size',
                                            'rules' => 'required|trim|xss_clean|htmlspecialchars|max_length[5]|numeric'
                                         )
                                    ),
                'general_settings' => array(
									array(
                                            'field' => 'site_name',
                                            'label' => 'Site name',
                                            'rules' => 'required|trim|xss_clean|htmlspecialchars|max_length[255]'
                                         ),
                                    array(
                                            'field' => 'site_email',
                                            'label' => 'Site E-mail',
                                            'rules' => 'required|trim|xss_clean|htmlspecialchars|max_length[60]|valid_email'
                                         ),
                                    array(
                                            'field' => 'tickets_per_page',
                                            'label' => 'Tickets per page',
                                            'rules' => 'required|trim|xss_clean|htmlspecialchars|max_length[3]|numeric'
                                         )
                                    )
									
               );
?>