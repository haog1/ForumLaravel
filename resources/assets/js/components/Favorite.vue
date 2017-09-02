<template>
    <button type="submit" :class="btnes" @click="toggle" style="margin-right: 10px;">
        <span :class="classes"></span>
        <span v-text="likesCount"></span>
    </button>
</template>


<script>
    export default {

        props:['reply'],

        data() {
            return {
                likesCount: this.reply.favoritesCount,
                isFavorited: this.reply.isFavorited
            }
        },

        computed:{
            classes() {
                return ['glyphicon', this.isFavorited ? 'glyphicon-heart' : 'glyphicon-heart-empty'];
            },
            btnes(){
                return ['btn', this.isFavorited ? 'btn-primary' : 'btn-default'];
            }
        },

        methods: {
            toggle(){
                if (this.isFavorited) {
                    axios.delete("/replies/" + this.reply.id + "/favorites"); //create the endpoint
                    this.isFavorited = false;
                    this.likesCount--;
                }else{
                    axios.post("/replies/" + this.reply.id + "/favorites");
                    this.isFavorited = true;
                    this.likesCount++;

                }
            }
        }

    }

</script>