
    <? $request = Bitrix\Main\Application::getInstance()->getContext()->getRequest(); ?>
    
    <? if ($request->get('print')) { ?>
        <script>
            window.print();
        </script>
    <? } ?>
    </body>
</html>