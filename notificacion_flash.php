<?php

const FLASH = 'FLASH_MESSAGES';
const FLASH_ERROR = 'error';
const FLASH_WARNING = 'warning';
const FLASH_INFO = 'info';
const FLASH_SUCCESS = 'success';

function flash(string $message, string $type = FLASH_INFO, string $name = 'default'): void
{
    if (!isset($_SESSION[FLASH])) {
        $_SESSION[FLASH] = [];
    }
    $_SESSION[FLASH][$name] = ['message' => $message, 'type' => $type];
}

function format_flash_message(array $flash_message): string
{
    $message = htmlspecialchars($flash_message['message'] ?: 'Mensaje sin contenido');
    $type = htmlspecialchars($flash_message['type']);
    return "<div class='alert alert-{$type}'>{$message}</div>";
}

function display_flash_message(string $name = 'default'): void
{
    if (isset($_SESSION[FLASH][$name])) {
        echo format_flash_message($_SESSION[FLASH][$name]);
        unset($_SESSION[FLASH][$name]); 
    }
}

function display_all_flash_messages(): void
{
    if (isset($_SESSION[FLASH]) && is_array($_SESSION[FLASH])) {
        foreach ($_SESSION[FLASH] as $name => $flash_message) {
            echo format_flash_message($flash_message);
        }
        unset($_SESSION[FLASH]); 
    }
}