<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? IncludeComponentTemplateLangFile(__FILE__, $this->GetFolder()) ?>

<? use Glyf\Core\Helpers\Text as TextHelper ?>

<? $this->setFrameMode(true); ?>

<? $folder = $this->getFolder() ?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8" />
    <title>OSCAR</title>
</head>
<body style="margin: 0;padding: 0;">

<!-- Общая таблица, контейнер с шапкой и подвалом -->
<table cellpadding="0" cellspacing="0" border="0" width="600" align="center" valign="top" style="text-align: left;vertical-align: top;background-image: url('<?= $folder ?>/images/mail-bg.png');background-position: 50% 0;background-repeat: no-repeat;">
    <!-- Шапка -->
    <tr>
        <td style="height: 177px;padding-top: 20px;padding-left: 20px;vertical-align: top;" height="197">
            <a href="http://<?= SITENAME ?>/" style="border: none;">
                <img src="<?= $folder ?>/images/logo.png" alt="OSCAR" />
            </a>
        </td>
    </tr>
    <!--// .Шапка -->




    <!-- Секция -->
    <tr>
        <td>
            <table cellpadding="0" cellspacing="0" border="0" align="center" valign="top" style="text-align: left;vertical-align: top;width: 100%;">
                <tr>
                    <td valign="top">

                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <!--// .Секция -->

    <tr>
        <td valign="top">
            <table cellpadding="0" cellspacing="0" border="0" align="center" valign="top" style="text-align: left;vertical-align: top;width: 100%;background-color: #f2f2f2;padding-bottom: 25px;">
                <? /*
                <tr>
                    <td valign="top">
                        <p style="margin-top: 0;margin-right: 0;margin-bottom: 0;margin-left: 0;padding-top: 20px;padding-right: 0;padding-bottom: 0;padding-left: 0;font-family: Arial, helvetika, sans-serif;font-size: 11px;text-align: center;color: #808080;text-transform: uppercase;">Новая коллекция в разделе живопись</p>
                        <p style="margin-top: 0;margin-right: 0;margin-bottom: 0;margin-left: 0;padding-top: 23px;padding-right: 0;padding-bottom: 0;padding-left: 0;font-family: Arial, helvetika, sans-serif;font-size: 22px;text-align: center;color: #00c3d9;text-transform: uppercase;">Шаблон верстки 1 / 10 импрессионистов</p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p style="margin-top: 0;margin-right: 0;margin-bottom: 0;margin-left: 0;padding-top: 22px;padding-right: 20px;padding-bottom: 0;padding-left: 20px;font-family: Arial, helvetika, sans-serif;font-size: 12px;line-height: 17px;text-align: left;color: #4d4d4d;">Импрессионизм – направление в живописи, зародившееся во Франции в XIX-XX веках, являющее собой художественную попытку запечатлеть какой-нибудь момент жизни во всей его изменчивости и подвижности. Картины импрессионистов словно качественно смытая фотография, возрождающая в фантазии продолжение увиденной истории. В этой статье мы рассмотрим 10 самых известных импрессионистов мира. К счастью, талантливых художников гораздо больше десяти, двадцати или даже ста, поэтому давайте остановимся на тех именах, которые нужно знать обязательно.</p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <table cellpadding="0" cellspacing="0" border="0" align="center" valign="middle" style="padding-top: 15px;">
                            <tr>
                                <td><img src="<?= $folder ?>/images/mail_btn_left.png" style="display: block;margin: 0;" alt=""></td>
                                <td style="background-color: #00c3d9;"><a href="#" style="color: #ffffff;text-decoration: none;text-transform: uppercase;font-size: 12px;">перейти</a></td>
                                <td><img src="<?= $folder ?>/images/mail_btn_right.png" style="display: block;margin: 0;" alt=""></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                */ ?>
            </table>
        </td>
    </tr>
    
    
    <? // БЛОГИ // ?>
    <? if (!empty($arResult['BLOGS']['ITEMS'])) { ?>
        <tr>
            <td valign="top">
                <table cellpadding="0" cellspacing="0" border="0" align="center" valign="top" style="text-align: left;vertical-align: top;width: 100%;padding-bottom: 40px;">
                    <tr>
                        <td>
                            <p style="margin-top: 0;margin-right: 0;margin-bottom: 0;margin-left: 0;padding-top: 23px;padding-right: 0;padding-bottom: 0;padding-left: 0;font-family: Arial, helvetika, sans-serif;font-size: 18px;text-align: center;color: #000000;text-transform: uppercase;">
                            Новые статьи в разделе блог
                        </p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p style="margin-top: 0;margin-right: 0;margin-bottom: 0;margin-left: 0;padding-top: 20px;padding-right: 0;padding-bottom: 23px;padding-left: 0;font-family: Arial, helvetika, sans-serif;font-size: 11px;text-align: center;color: #808080;text-transform: uppercase;line-height: 18px;">
                                <?  // Разделы блога.
                                    $sections = array();
                                    foreach ($arResult['BLOGS']['SECTIONS'] as $section) {
                                        $sections []= $section['UF_LANG_TITLE_RU'];
                                    }
                                ?>
                                В этом месяце появилось 
                                <?= TextHelper::decofnum(count($arResult['BLOGS']['ITEMS']), array('новая статья', 'новые статьи', 'новых статей'), true) ?>
                                в разделах: <br> 
                                <?= implode(', ', $sections) ?>.
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <table cellpadding="0" cellspacing="0" border="0" align="center" valign="top" style="text-align: left;vertical-align: top;width: 100%;">
                                <? $chunks = array_chunk($arResult['BLOGS']['ITEMS'], 3, true) ?>
                                <? foreach ($chunks as $chunk) { ?>
                                    <tr>
                                        <? foreach ($chunk as $item) { ?>
                                            <td valign="top" style="padding-left: 23px;width: 170px;">
                                                <img src="http://<?= SITENAME ?>/i.php?src=<?= $item['PICTURE'] ?>&w=169&h=165" style="display: block;border: 0;" />
                                            </td>
                                        <? } ?>
                                    </tr>
                                    <tr>
                                        <? foreach ($chunk as $item) { ?>
                                            <td valign="top" style="padding-left: 23px; padding-bottom: 10px; width: 170px;font-family: Arial, helvetika, sans-serif;font-size: 12px;line-height: 17px;">
                                                <a href="http://<?= SITENAME ?><?= $item['DETAIL_PAGE_URL'] ?>" style="text-decoration: none;color: #666666;">
                                                    <b style="font-weight: 700;display: block;color: #333333; margin-top: 10px;margin-bottom: 5px;">
                                                        <i><?= $arResult['BLOGS']['SECTIONS'][$item['IBLOCK_SECTION_ID']]['UF_LANG_TITLE_RU'] ?></i>: 
                                                        <?= $item['PROPERTY_LANG_TITLE_RU_VALUE'] ?>
                                                    </b>
                                                    <?= $item['PROPERTY_LANG_SUBTITLE_RU_VALUE'] ?>
                                                </a>
                                            </td>
                                        <? } ?>
                                    </tr>
                                <? } ?>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style="font-family: Arial, helvetika, sans-serif;font-size: 14px;text-align: center;color: #666666;padding-top: 45px;padding-bottom: 10px;">
                            Читайте все наши новые статьи за последний месяц
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <table cellpadding="0" cellspacing="0" border="0" align="center" valign="middle" style="padding-top: 15px;">
                                <tr>
                                    <td><img src="<?= $folder ?>/images/mail_btn_left.png" style="display: block;margin: 0;" alt=""></td>
                                    <td style="background-color: #00c3d9;">
                                        <a href="http://<?= SITENAME ?>/blog/" style="color: #ffffff;text-decoration: none;text-transform: uppercase;font-size: 12px;">
                                            перейти
                                        </a>
                                    </td>
                                    <td><img src="<?= $folder ?>/images/mail_btn_right.png" style="display: block;margin: 0;" /></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    <? } ?>
    
    
    <? /*
    <tr>
        <td valign="top">
            <table cellpadding="0" cellspacing="0" border="0" align="center" valign="top" style="text-align: left;vertical-align: top;width: 100%;background: #f2f2f2;padding-left: 23px;padding-right: 23px;">
                <tr>
                    <td>
                        <p style="margin-top: 0;margin-right: 0;margin-bottom: 0;margin-left: 0;padding-top: 23px;padding-right: 0;padding-bottom: 0;padding-left: 0;font-family: Arial, helvetika, sans-serif;font-size: 18px;text-align: center;color: #000000;text-transform: uppercase;">Шаблон верстки 3 / новые статьи в разделе блог</p>
                    </td>
                </tr>
                <tr>
                    <td style="padding-top: 20px;">
                        <img src="<?= $folder ?>/images/03.png"  alt="">
                    </td>
                </tr>
                <tr>
                    <td>
                        <p style="margin-top: 0;margin-right: 0;margin-bottom: 0;margin-left: 0;padding-top: 20px;padding-right: 0;padding-bottom: 20px;padding-left: 0;font-family: Arial, helvetika, sans-serif;font-size: 17px;color: #000000;">Заголовок тема название объекта автора тема <br> название объекта автора</p>
                    </td>
                </tr>
                <tr>
                    <td style="font-family: Arial, helvetika, sans-serif;font-size: 12px;color: #4d4d4d;padding-bottom: 35px;">
                        Импрессионизм – направление в живописи, зародившееся во Франции в XIX-XX веках, являющее собой художественную попытку запечатлеть какой-нибудь момент жизни во всей его изменчивости и подвижности. Картины импрессионистов словно качественно смытая фотография, возрождающая в фантазии продолжение увиденной истории. В этой статье мы рассмотрим 10 самых известных импрессионистов мира. К счастью, талантливых художников гораздо больше десяти, двадцати или даже ста, поэтому давайте остановимся на тех именах, которые нужно знать обязательно.
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    */ ?>
    
    
    <? // КОЛЛЕКЦИИ // ?>
    <? if (!empty($arResult['COLLECTIONS']['ITEMS'])) { ?>
        <tr>
            <td>
                <table cellpadding="0" cellspacing="0" border="0" align="center" valign="top" style="text-align: left;vertical-align: top;width: 100%;">
                    <tr>
                        <td>
                            <p style="margin-top: 0;margin-right: 0;margin-bottom: 0;margin-left: 0;padding-top: 23px;padding-right: 0;padding-bottom: 0;padding-left: 0;font-family: Arial, helvetika, sans-serif;font-size: 18px;text-align: center;color: #000000;text-transform: uppercase;">
                                Коллекции
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p style="margin-top: 0;margin-right: 0;margin-bottom: 0;margin-left: 0;padding-top: 23px;padding-right: 0;padding-bottom: 25px;padding-left: 0;font-family: Arial, helvetika, sans-serif;font-size: 11px;text-align: center;color: #00c3d9;text-transform: uppercase;line-height: 15px;">
                                В коллекциях есть пополнение:
                            </p>
                        </td>
                    </tr>
                    <? foreach ($arResult['COLLECTIONS']['ITEMS'] as $collection) { ?>
                        <tr>
                            <td>
                                <table cellpadding="0" cellspacing="0" border="0" align="center" valign="top" style="text-align: left;vertical-align: top;width: 100%;">
                                    <tr>
                                        <td valign="top" align="left" width="32">
                                            <img src="<?= $folder ?>/images/arrow.gif" />
                                        </td>
                                        <td colspan="2">
                                            <b><?= $collection['UF_LANG_TITLE_RU'] ?></b>
                                        </td>
                                    </tr>
                                    <? foreach ($collection['ITEMS'] as $item) { ?>
                                        <tr>
                                            <td valign="top" align="left" width="32">
                                                &nbsp;
                                            </td>
                                            <td valign="top" align="left" width="16">
                                                <img src="<?= $folder ?>/images/bullet.gif" alt="">
                                            </td>
                                            <td>
                                                <a href="http://<?= SITENAME ?>/collections/<?= $item['ID'] ?>/" style="text-decoration: none;color: #000000;">
                                                    <?= $item['UF_LANG_TITLE_RU'] ?>
                                                </a>
                                            </td>
                                        </tr>
                                    <? } ?>
                                    <tr>
                                        <td colspan="3">
                                            <table cellpadding="0" cellspacing="0" border="0" align="left" valign="middle" style="padding-top: 15px;padding-bottom: 25px;">
                                                <tr>
                                                    <td><img src="<?= $folder ?>/images/mail_btn_left.png" style="display: block;margin: 0;" /></td>
                                                    <td style="background-color: #00c3d9;">
                                                        <a href="http://<?= SITENAME ?>/collections/<?= $collection['CODE'] ?>/" style="color: #ffffff;text-decoration: none;text-transform: uppercase;font-size: 12px;">
                                                            перейти
                                                        </a>
                                                    </td>
                                                    <td><img src="<?= $folder ?>/images/mail_btn_right.png" style="display: block;margin: 0;" /></td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    
                    <? } ?>
                </table>
            </td>
        </tr>
    <? } ?>
    
    
    <? // СОХРАНЕННЫЙ ПОИСК // ?>
    <? if (!empty($arResult['SEARCHES']['ITEMS'])) { ?>
        <tr>
            <td>
                <table cellpadding="0" cellspacing="0" border="0" align="center" valign="top" style="text-align: left;vertical-align: top;width: 100%;">
                    <tr>
                        <td>
                            <p style="margin-top: 0;margin-right: 0;margin-bottom: 0;margin-left: 0;padding-top: 23px;padding-right: 0;padding-bottom: 0;padding-left: 0;font-family: Arial, helvetika, sans-serif;font-size: 18px;text-align: center;color: #000000;text-transform: uppercase;">
                                Сохраненный поиск
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p style="margin-top: 0;margin-right: 0;margin-bottom: 0;margin-left: 0;padding-top: 23px;padding-right: 0;padding-bottom: 25px;padding-left: 0;font-family: Arial, helvetika, sans-serif;font-size: 11px;text-align: center;color: #00c3d9;text-transform: uppercase;line-height: 15px;">
                                в вашем сохраненном поиске<br> есть пополнение:
                            </p>
                        </td>
                    </tr>
                    <? foreach ($arResult['SEARCHES']['ITEMS'] as $search) { ?>
                        <tr>
                            <td>
                                <table cellpadding="0" cellspacing="0" border="0" align="center" valign="top" style="text-align: left;vertical-align: top;width: 100%;">
                                    <tr>
                                        <td valign="top" align="left" width="32">
                                            <img src="<?= $folder ?>/images/arrow.gif" />
                                        </td>
                                        <td colspan="2">
                                            <b><?= $search['TITLE'] ?></b>
                                        </td>
                                    </tr>
                                    <? foreach ($search['ITEMS'] as $item) { ?>
                                        <tr>
                                            <td valign="top" align="left" width="32">
                                                &nbsp;
                                            </td>
                                            <td valign="top" align="left" width="16">
                                                <img src="<?= $folder ?>/images/bullet.gif" alt="">
                                            </td>
                                            <td>
                                                <a href="http://<?= SITENAME ?>/collections/<?= $item['ID'] ?>/" style="text-decoration: none;color: #000000;">
                                                    <?= $item['UF_LANG_TITLE_RU'] ?>
                                                </a>
                                            </td>
                                        </tr>
                                    <? } ?>
                                    <tr>
                                        <td colspan="3">
                                            <table cellpadding="0" cellspacing="0" border="0" align="left" valign="middle" style="padding-top: 15px;padding-bottom: 25px;">
                                                <tr>
                                                    <td><img src="<?= $folder ?>/images/mail_btn_left.png" style="display: block;margin: 0;" /></td>
                                                    <td style="background-color: #00c3d9;">
                                                        <a href="http://<?= SITENAME ?>/search/?<?= $search['LINK'] ?>" style="color: #ffffff;text-decoration: none;text-transform: uppercase;font-size: 12px;">
                                                            перейти
                                                        </a>
                                                    </td>
                                                    <td><img src="<?= $folder ?>/images/mail_btn_right.png" style="display: block;margin: 0;" /></td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    
                    <? } ?>
                </table>
            </td>
        </tr>
    <? } ?>

    <? /*
    <tr>
        <td>
            <table cellpadding="0" cellspacing="0" border="0" align="center" valign="top" style="text-align: left;vertical-align: top;width: 100%;background-color: #f2f2f2;">
                <tr>
                    <td valign="top" align="center">
                        <img src="<?= $folder ?>/images/mail_img.jpg" alt="">
                    </td>
                </tr>
                <tr>
                    <td>
                        <p style="margin-top: 0;margin-right: 0;margin-bottom: 0;margin-left: 0;padding-top: 23px;padding-right: 0;padding-bottom: 25px;padding-left: 0;font-family: Arial, helvetika, sans-serif;font-size: 22px;text-align: center;color: #00c3d9;text-transform: uppercase;">Шаблон верстки 1 / 10 импрессионистов</p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p style="margin-top: 0;margin-right: 0;margin-bottom: 0;margin-left: 0;padding-right: 23px;padding-bottom: 25px;padding-left: 23px;font-family: Arial, helvetika, sans-serif;font-size: 12px;color: #4d4d4d;line-height: 17px;">Импрессионизм – направление в живописи, зародившееся во Франции в XIX-XX веках, являющее собой художественную попытку запечатлеть какой-нибудь момент жизни во всей его изменчивости и подвижности. Картины импрессионистов словно качественно смытая фотография, возрождающая в фантазии продолжение увиденной истории. В этой статье мы рассмотрим 10 самых известных импрессионистов мира. К счастью, талантливых художников гораздо больше десяти, двадцати или даже ста, поэтому давайте остановимся на тех именах, которые нужно знать обязательно.</p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    */ ?>
    

    <tr>
        <td valign="top">
            <table cellpadding="0" cellspacing="0" border="0" align="center" valign="top" style="height: 118px;text-align: left;vertical-align: top;background-color: #212121;background-image: url('<?= $folder ?>/images/footer.jpg');background-position: 0 0;background-repeat: repeat-x;">
                <tr>
                    <td valign="top" width="114" align="center" style="padding-top: 20px;">
                        <a href="http://<?= SITENAME ?>/">
                            <img src="<?= $folder ?>/images/logo_footer.png" alt="OSCAR" />
                        </a>
                    </td>
                    <td width="372" align="center">
                        <p style="margin-top: 0;margin-right: 0;margin-bottom: 0;margin-left: 0;padding-top: 0;padding-right: 0;padding-bottom: 0;padding-left: 0;font-family: Arial, helvetika, sans-serif;font-size: 18px;text-align: center;color: #00c3d9;text-transform: uppercase;"><span style="font-weight: 300;">Телефон:</span> +7 916 301 34 50</p>
                        <p style="margin-top: 0;margin-right: 0;margin-bottom: 0;margin-left: 0;padding-top: 0;padding-right: 0;padding-bottom: 0;padding-left: 0;font-family: Arial, helvetika, sans-serif;font-size: 18px;text-align: center;color: #00c3d9;text-transform: uppercase;"><a style="font-weight: 300;text-decoration: none;color: #00c3d9;">Email:</a> office@OscarArtAgency.ru</p>
                        <p style="margin-top: 0;margin-right: 0;margin-bottom: 0;margin-left: 0;padding-top: 0;padding-right: 0;padding-bottom: 0;padding-left: 0;font-family: Arial, helvetika, sans-serif;font-size: 10px;color: #666666;text-transform: uppercase;">2015 &copy; Арт агентство «Оскар» </p>
                    </td>
                    <td width="114">
                        &nbsp;
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>

</body>
</html>