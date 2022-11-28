<template>
	<div class="container-fluid rounded m-1 p-2 bg-light">
		<div v-if="content.activitytitle">
			<h2 class="text-dark display-6"><i class="bi bi-heart-pulse"></i>&nbsp;ACTIVITY:&nbsp;{{ content.activitytitle }}</h2>
		</div>
		<div v-if="content.activitycontent">
			{{ content.activitycontent }}
		</div>
	</div>
</template>

<script>
</script>

<style>
</style>

