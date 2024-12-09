<?php

class Adventures {

    private $settings;

    public function __construct() {
        $this->set_settings();
        $this->init_hooks();
    }

    private function init_hooks() {
        add_action('admin_menu', [$this, 'register_settings_pages']);
        add_action('admin_init', [$this, 'register_settings_sections']);
        add_action('admin_init', [$this, 'register_settings_fields']);
    }

    public function register_settings_pages() {
        foreach ($this->settings['pages'] as $page) {
            add_options_page($page['title'], $page['title'], $page['capability'], $page['slug'], [$this, 'settings_page_callback']);    
        }
    }

    public function settings_page_callback() {
        $this->render('settings.php');
    }

    public function register_settings_sections() {
        foreach ($this->settings['sections'] as $section) {
            add_settings_section($section['id'], $section['title'], [$this, 'settings_section_callback'], ADV__PLUGIN_SLUG, $section);
        }
    }

    public function settings_section_callback($args) {
        $this->render($args['view'], $args);
    }

    public function register_settings_fields() {
        foreach ($this->settings['fields'] as $field) {
            add_settings_field($field['id'], $field['title'], [$this, 'settings_field_callback'], ADV__PLUGIN_SLUG, $field['section'], $field);
            
            register_setting(ADV__PLUGIN_SLUG, $field['id']);
        }
    }
    
    public function settings_field_callback($args) {
        $this->render($args['view'], $args);
    }

    private function render($filename, $args = false) {
        if (is_array($args)) {
            $value = get_option($args['id']);
            
            if (empty($value) && isset($args['default'])) {
                $value = $args['default'];
            }

            $args = array_merge($args, ['value' => $value]);
        }

        $file = ADV__PLUGIN_VIEW . $filename;

        if (!str_ends_with($file,'.php')) {
            $file .= '.php';
        }

        if(!file_exists($file)) {
            die('File not found ' . $filename);
        }
        
        require $file;
    }

    private function set_settings() {
        $data = $this->get_json_data();

        $this->settings = $data['settings'];
    }

    private function get_json_data() {
        $file = ADV__PLUGIN_DIR . 'adventures.json';

        if (!file_exists($file)) {
            die('adventures.json not found');
        }

        return json_decode(file_get_contents($file), true);
    }
}
