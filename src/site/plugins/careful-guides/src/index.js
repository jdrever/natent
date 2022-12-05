import Heading from './components/Heading.vue'
import Activity from  './components/Activity.vue'
import File from './components/File.vue'

panel.plugin("careful-digital/guides", {
  blocks: {
    activity: Activity,
    heading: Heading,
    file: File
}});
