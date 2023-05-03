<?php

function tutor_commission_addon_enqueue_script()
{
    wp_enqueue_style('cpm_custom_for_css_admin', plugin_dir_url(__FILE__) . '/assets/css/style.css');
}
add_action('admin_enqueue_scripts', 'tutor_commission_addon_enqueue_script');

function cpm_plugin_top_menu()
{
    add_menu_page('IR Setting', 'IR Setting', 'manage_options', __FILE__, 'cpm_render_plugin_page');
    // add_submenu_page(__FILE__, 'Setting', 'Setting', 'manage_options', __FILE__ . '/setting', 'cpm_render_setting_page');
    // add_submenu_page(__FILE__, 'About', 'About', 'manage_options', __FILE__ . '/about', 'cpm_render_about_page');
}
function cpm_render_plugin_page()
{
    if (isset($_POST['save'])) {
        $secret_key = $_POST['secret_key'];
        $client_id = $_POST['client_id'];
        $early = array($_POST['early_price']);
        $experienced = array($_POST['experienced_price']);
        $management = array($_POST['management_price']);
        $military = array($_POST['military_price']);
        array_push($early, $_POST['early_package']);
        array_push($experienced, $_POST['experienced_package']);
        array_push($management, $_POST['management_package']);
        array_push($military, $_POST['military_package']);
        update_option('stripe_secret_key', $secret_key);
        update_option('stripe_client_id', $client_id);
        update_option('package_early', $early);
        update_option('package_experienced', $experienced);
        update_option('package_management', $management);
        update_option('package_military', $military);
        // var_dump($early);
    } ?>
    <form method="post">
        <?php
        $secret_api_key = get_option('stripe_secret_key');
        $secret_client_id = get_option('stripe_client_id');
        $package_early = get_option('package_early');
        $package_experienced = get_option('package_experienced');
        $package_management = get_option('package_management');
        $package_military = get_option('package_military');
        ?>
        <h1> Payment Details </h1>

        <fieldset>

            <legend><span class="number">1</span> Stripe Details</legend>

            <label for="Client id">Client Id : </label>
            <input type="text" id="client_id" name="client_id" value="<?php echo !empty($secret_client_id) ? $secret_client_id : ''; ?>">

            <label for="secret key">Secret Key : </label>
            <input type="text" id="secret_key" name="secret_key" value="<?php echo !empty($secret_api_key) ? $secret_api_key : ''; ?>">

        </fieldset>
        <fieldset>

            <legend><span class="number">2</span>Package Price </legend>
            <table class="cpm_table">
                <tr>
                    <th>&nbsp;</th>
                    <th>Price</th>
                    <th>Package</th>
                </tr>
                <tr>
                    <th>College/Early Career</th>
                    <td><input type="text" name="early_price" value="<?php echo !empty($package_early) ? $package_early[0] : ''; ?>" /></td>
                    <td><input type="text" name="early_package" value="<?php echo !empty($package_early) ? $package_early[1] : ''; ?>" /></td>
                </tr>
                <tr>
                    <th>Experienced</th>
                    <td><input type="text" name="experienced_price" value="<?php echo !empty($package_experienced) ? $package_experienced[0] : ''; ?>" /></td>
                    <td><input type="text" name="experienced_package" value="<?php echo !empty($package_experienced) ? $package_experienced[1] : ''; ?>" /></td>
                </tr>
                <tr>
                    <th>Management or Executive</th>
                    <td><input type="text" name="management_price" value="<?php echo !empty($package_management) ? $package_management[0] : ''; ?>" /></td>
                    <td><input type="text" name="management_package" value="<?php echo !empty($package_management) ? $package_management[1] : ''; ?>" /></td>
                </tr>
                <tr>
                    <th>Military Transaction</th>
                    <td><input type="text" name="military_price" value="<?php echo !empty($package_military) ? $package_military[0] : ''; ?>" /></td>
                    <td><input type="text" name="military_package" value="<?php echo !empty($package_military) ? $package_military[1] : ''; ?>" /></td>
                </tr>
            </table>


        </fieldset>
        <input type="submit" value="save" name="save">
    </form> <?php
        }
        // function cpm_render_setting_page()
        // {
        // }
        // function cpm_render_about_page()
        // {
        // }
        add_action('admin_menu', 'cpm_plugin_top_menu');
