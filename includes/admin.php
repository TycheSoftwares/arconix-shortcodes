<?php
/**
     * Adds a news widget to the dashboard.
     *
     * @since 1.0
     */
    function register_dashboard_widget() {
        wp_add_dashboard_widget( 'ac-shortcodes', 'Arconix Shortcodes', 'dashboard_widget_output' );
    }

    /**
     * Output for the dashboard widget
     *
     * @since 1.0
     */
    function dashboard_widget_output() {
        echo '<div class="rss-widget">';

        wp_widget_rss_output( array(
            'url' => 'http://arconixpc.com/tag/arconix-shortcodes/feed', // feed url
            'title' => 'Arconix Shortcodes News', // feed title
            'items' => 3, //how many posts to show
            'show_summary' => 1, // 1 = display excerpt
            'show_author' => 0, // 1 = display author
            'show_date' => 1 // 1 = display post date
        )); ?>

        <div class="acs-widget-bottom">
            <ul>
                <li><img src="<?php echo ACS_IMAGES_URL . 'admin/page-16x16.png'?>"><a href="http://arcnx.co/aswiki">Wiki Page</a></li>
                <li><img src="<?php echo ACS_IMAGES_URL . 'admin/help-16x16.png'?>"><a href="http://arcnx.co/ashelp">Support Forum</a></li>
                <li><img src="<?php echo ACS_IMAGES_URL . 'admin/trello-16x16.png'; ?>"><a href="http://arcnx.co/astrello">Dev Board</a></li>
                <li><img src="<?php echo ACS_IMAGES_URL . 'admin/github-16x16.png'; ?>"><a href="http://arcnx.co/assource">Source Code</a></li>
            </ul>
        </div></div>

        <?php // handle the styling
        echo '<style type="text/css">
            #ac-shortcodes .rsssummary { display: block; }
            #ac-shortcodes .acs-widget-bottom { border-top: 1px solid #ddd; padding-top: 10px; text-align: center; }
            #ac-shortcodes .acs-widget-bottom ul { list-style: none; }
            #ac-shortcodes .acs-widget-bottom ul li { display: inline; padding-right: 20px; }
            #ac-shortcodes .acs-widget-bottom img { padding-right: 3px; vertical-align: middle; }
        </style>';
    }
?>