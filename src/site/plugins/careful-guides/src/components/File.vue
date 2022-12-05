<template>
    <k-block-figure
    :is-empty="!file.url"
    empty-icon="file"
    empty-text="No file selected yet …"
    @open="open"
    @update="update"
    >
    <div class="k-block-type-file-wrapper">
      <p>File: {{ file.filename }}</p>
      <p>Label: {{ label }}</p>
    </div>
    </k-block-figure>
</template>

<script>
export default {
  computed: {
    file() {
      return this.content.file[0] || {};
    },
    label() {
        return this.content.label || '';
    }
  }
};
</script>

<style>
.k-block-type-file-wrapper {
    display: block;
    background-color: #efefef;
    padding: 1em;
    border-radius: 2px;
}
.k-block-type-file-wrapper p {
    margin-bottom: 0.2em;
    color: #777777;
    font-size: 14px;
}
</style>