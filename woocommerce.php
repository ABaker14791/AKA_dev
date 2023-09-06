<?php get_header('shop'); ?>
<main>

    <div class="aka-shop-wrapper">

        <script>// <![CDATA[
            function goBack() { window.history.back() }
        // ]]></script>
    <button onclick="goBack()" class="back-btn">Go Back</button>

        <?php woocommerce_content(); ?>
    </div>
</main>








<?php get_footer(); ?>