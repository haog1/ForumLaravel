<script>

    import Favorite from './Favorite.vue'

    export default {
        props: ['attributes'],

        components: {Favorite},

        data() {
            return {
                editing: false,
                body: this.attributes.body
            };

        },

        methods: {
            update() {
                axios.patch('/replies/' + this.attributes.id, {
                    body: this.body
                });
                this.editing = false;
                flash('Updated!');
            }
        }
    }
</script>