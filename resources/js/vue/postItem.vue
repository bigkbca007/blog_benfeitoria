<template>
    <div>
        <img :src="getImage(item.img_post)" class="img_post">
        <span>{{ item.titulo }}</span>&nbsp;
        <span v-if="remover == 0">{{ item.created_at }}</span>&nbsp;
        <span v-if="remover == 0">{{ item.updated_at }}</span>&nbsp;
        <button v-if="remover == 1" @click="removerPost()">
            remover
        </button>
        <a :href="getLink(item.id)">Visualisar</a>
    </div>
</template>

<script>
export default {
    props: [
        'item',
        'remover'
    ],
    methods: {
        removerPost() {
            axios.delete('/posts/' + this.item.id)
            .then(res => {
                if(res.status == 200){
                    this.$emit('listamudada');
                }
            })
            .catch(error => {
                console.error(error);
            });
        },
        getImage(img_post){
            return '/images/'+img_post;
        },
        getLink(id){
            return '/posts/'+id;
        }
    }
}
</script>

<style scoped>
    .img_post{
        width: 50px;
    }
</style>