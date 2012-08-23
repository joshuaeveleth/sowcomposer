<?php

class Templateparser {

    public static function parse($raw_template)
    {
      //High-level blocks
      $blocks = preg_split('/\-\-\-(\w+)\-\-\-/', $raw_template, -1, PREG_SPLIT_DELIM_CAPTURE);
      $trimmed_blocks = array_map('trim', $blocks);

      $tp = new Template();
      $tp->title = $trimmed_blocks[2];

      $blocks = array_slice($trimmed_blocks, 4);

      $section_type = "deliverable";
      $ord = 0;
      $vars = array();

      foreach($blocks as $block) {
        if ($block == "REQUIREMENTS") {
          $section_type = "requirement";
          continue;
        }
        $bits = preg_split('/(^#|[\r\n]+#)\s/', $block, -1, PREG_SPLIT_NO_EMPTY);
        foreach($bits as $bit) {
          $ts = new TemplateSection();
          $sec_bits = preg_split('/[\r\n]#{2,3}/', $bit);
          $ts->title = trim($sec_bits[0]);
          $ts->section_type = $section_type;
          if (count($sec_bits) < 3) { //no help text
            $ts->help_text = '';
            $ts->body = trim($sec_bits[1]);
          } else {
            $ts->help_text = trim($sec_bits[1]);
            $ts->body = trim($sec_bits[2]);
          }

          $ts->display_order = $ord;

          preg_match_all('/\{\{\s*([^\}]*)\}\}/', $ts->body, $variables);
          foreach($variables[1] as $var) {

            $var_bits = explode("|", $var);
            $var_name = trim(isset($var_bits[0]) ? $var_bits[0] : $var);
            //avoid dupes
            if (!array_key_exists($var_name, $vars)) {
              $vars[$var_name] = array();
            }
            if (count($var_bits) > 1) $vars[$var_name]['name'] = trim($var_bits[1]);
            if (count($var_bits) > 2) $vars[$var_name]['help_text'] = trim($var_bits[2]);
          }

          $sections[] = $ts;
          $ord++;
        }
      }

      $tp->variables = $vars;
      $tp->save();
      $tp->template_sections()->save($sections);

      return $tp;
    }

}