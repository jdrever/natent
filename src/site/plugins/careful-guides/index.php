<?php
Kirby::plugin(
  'careful-digital/guides',
  [
    'blueprints' => [
      'blocks/activity' => __DIR__ . '/blueprints/blocks/activity.yml',
      'blocks/image' => __DIR__ . '/blueprints/blocks/image.yml',
      'blocks/heading' => __DIR__ . '/blueprints/blocks/heading.yml',
    ],
    'snippets' => [
      'blocks/image' => __DIR__ . '/snippets/blocks/image.php',
      'blocks/heading' => __DIR__ . '/snippets/blocks/heading.php',
    ],
  ]
);
