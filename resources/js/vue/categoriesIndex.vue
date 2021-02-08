<template>
    <div>
        <h3>Categorias - Index</h3>
        <a href="/categorias/add">Create</a>
        <a href="/categorias/5">Categoria 5</a>
        
        <!-- Lista de categorias -->
        <categories-itens-list :items="items" :remover="remover" />
    </div>
</template>

// Javascript ------------------------------------------------
<script>
import categoriesItensList from './categoriesItensList';
export default {
    components: {
        categoriesItensList
    },
    data: function(){
        return {
            items: [],
            remover: 0
        }
    },
    methods: {
        getCategorias: function(){
            axios.get('/categorias/buscar', {
                params: {
                    termos: ''
                }
            }).then(res => {
                this.items = res.data;
            });
        },

    },
    created(){
        this.getCategorias()
    }
}
</script>

// Style -----------------------------------------------------
<style lang="stylus" scoped>

</style>