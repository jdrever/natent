<?php
Kirby::plugin(
  'careful-digital/guides',
  [
    'blueprints' => [
      'blocks/activity' => __DIR__ . '/blueprints/blocks/activity.yml',
      'blocks/text' => __DIR__ . '/blueprints/blocks/text.yml',
      'blocks/lead-text' => __DIR__ . '/blueprints/blocks/lead-text.yml',
      'blocks/image' => __DIR__ . '/blueprints/blocks/image.yml',
      'blocks/gallery' => __DIR__ . '/blueprints/blocks/gallery.yml',
      'blocks/heading' => __DIR__ . '/blueprints/blocks/heading.yml',
      'blocks/file' => __DIR__ . '/blueprints/blocks/file.yml',
      'blocks/google-slide' => __DIR__ . '/blueprints/blocks/google-slide.yml',
      'blocks/link-to-commons' => __DIR__ . '/blueprints/blocks/link-to-commons.yml',
      'fields/guideContent' => __DIR__ . '/blueprints/fields/guideContent.yml',
      'fields/mainContent' => __DIR__ . '/blueprints/fields/mainContent.yml',
      'fields/backgroundColour' => __DIR__ . '/blueprints/fields/backgroundColour.yml',
    ],
    'snippets' => [
      'blocks/image' => __DIR__ . '/snippets/blocks/image.php',
      'blocks/gallery' => __DIR__ . '/snippets/blocks/gallery.php',
      'blocks/heading' => __DIR__ . '/snippets/blocks/heading.php',
      'blocks/file' => __DIR__ . '/snippets/blocks/file.php',
      'blocks/text' => __DIR__ . '/snippets/blocks/text.php',
      'blocks/lead-text' => __DIR__ . '/snippets/blocks/lead-text.php',
      'blocks/quote' => __DIR__ . '/snippets/blocks/quote.php',
      'blocks/google-slide' => __DIR__ . '/snippets/blocks/google-slide.php',
      'blocks/link-to-commons' => __DIR__ . '/snippets/blocks/link-to-commons.php',
    ]
  ]
);
