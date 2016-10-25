<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

// Корневая папка - блог.
$APPLICATION->AddChainItem(getMessage('GL_BLOG'), '/blog/');

// Папка - архив блога.
$APPLICATION->AddChainItem(getMessage('GL_BLOG_ARCHIVE'));
