<?php

// Хук событие 'admin_menu', запуск функции 'mfp_Add_My_Admin_Link()'
add_action( 'admin_menu', 'Add_My_Admin_Link' );

// Добавляем новую ссылку в меню Админ Консоли
function Add_My_Admin_Link()
{
	add_menu_page(
		'Products Settings',
		'Products Settings',
		'manage_options',
		'admin-page.php'
	);
}