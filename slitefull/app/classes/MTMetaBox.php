<?php
/***********************
* Metaboxes            *
* Created by Brackets. *
* @package MT          *
* User: slitefull      *
* Date: 29/05/2020     *
* Time: 17:11 AM       *
***********************/

class MTMetaBox
{
    private $arguments = [];

    function __construct()
    {
        add_action( 'save_post', [$this, 'update'] );
    }

    public function render(){
        global $post;
        foreach ($this->arguments as $argument) {
            $condition = ($argument[4]) ? $argument[4] === $post->post_name : true;
            if($condition){
                add_meta_box(
                    $argument[1],
                    $argument[2],
                    $argument[3],
                    $argument[0],
                    'advanced'
                );
            }
        }
    }

    public function add($condition = false, $postType = '', $metaBoxName = '', $title = '', $callback = null)
    {
        $this->arguments[] = [
            $postType,
            $metaBoxName,
            $title,
            $callback,
            $condition,
        ];

        return $this;
    }

    public function addMetaBoxInit(){
        add_action( 'add_meta_boxes', [$this, 'render'] );
    }

    public function update($post_id)
    {
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return false;
        if (!current_user_can('edit_post', $post_id)) return false;

        if ($parent_id = wp_is_post_revision($post_id))
            $post_id = $parent_id;

        foreach ($_POST as $key => $value) {
            if(strpos($key, 'MT') !== false){
                update_post_meta($post_id, $key, $value);
            }
        }

        return $post_id;
    }
}
