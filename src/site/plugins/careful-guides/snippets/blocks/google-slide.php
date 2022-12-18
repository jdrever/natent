<style>
  .responsive-google-slides {
    position: relative;
    padding-bottom: 56.25%; /* 16:9 Ratio */
    height: 0;
    overflow: hidden;
  }
  .responsive-google-slides iframe {
    border: 0;
    position: absolute;
    top: 0;
    left: 0;
    width: 100% !important;
    height: 100% !important;
  }
</style>
<div class="responsive-google-slides"><iframe loading="lazy" src="<?=$block->slideUrl()?>/embed?start=false&amp;loop=false&amp;delayms=60000" allowfullscreen="true" mozallowfullscreen="true" webkitallowfullscreen="true" height="500" frameborder="0"></iframe></div>