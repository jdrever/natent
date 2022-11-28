import Heading from './components/Heading.vue'
import Activity from  './components/Activity.vue'

panel.plugin("careful-digital/guides", {
  blocks: {
    activity: Activity,
    heading: Heading
}});
