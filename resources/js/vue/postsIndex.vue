<template>
    <div>
        <!-- Filtros -->
        <fieldset>
            <div class="field has-addons">
                <div class="control">
                    <input v-model="filtro.titulo" class="input" type="text" placeholder="Filtrar por título">
                </div>
                <div class="control">
                    <a @click="filtrar(1)" class="button is-info">
                        Filtrar
                    </a>
                </div>
            </div>

            <div class="field has-addons">
                <div class="control">
                    <div class="select">
                        <v-select
                            :options="options_categorias"
                            :reduce="nome => nome.id"
                            label="nome"
                            v-model="filtro.categoria"
                        />

                    </div>
                </div>
                <div class="control">
                    <a @click="filtrar(2)" class="button is-info">
                        Filtrar
                    </a>
                </div>
            </div>

            <div class="field has-addons">
                <div class="control">
                    <input v-model="filtro.autor" class="input" type="text" placeholder="Filtrar por autor">
                </div>
                <div class="control">
                    <a @click="filtrar(3)" class="button is-info">
                        Filtrar
                    </a>
                </div>
            </div>

        </fieldset>

        <h3>Posts - Index</h3>
        <a href="/posts/add">Create</a>
        <a href="/posts/5">Post 5</a>

        <!-- Lista de categorias -->
        <post-itens-list :items="items" :remover="remover" />
    </div>
</template>

// Javascript ------------------------------------------------
<script>

import postItensList from './postsItensList';

export default {
    components: {
        postItensList
    },
    data: function(){
        return {
            items: [],
            remover: 0,
            filtro: {
                titulo: '',
                categoria: '',
                autor: ''
            },
            options_categorias: [],
            categoria_id: 0
        }
    },
    methods: {
        getPosts: function(){
            axios.get('/posts/buscar', {
                params: {
                    termos: ''
                }
            }).then(res => {
                this.items = res.data;
            });
        },
        filtrar: function(tipo){
            axios.get('/posts/buscar/', {
                params: {
                    tipo: tipo,
                    filtro: this.filtro
                }
            })
            .then(res => {
                if(200 == res.status){
                    this.items = res.data;
                }
            })
            .catch(error => {
                console.log(error);
            });
        },

    },
    created(){
        this.getPosts();

        axios.get('/categorias/getOptions')
        .then(res => {
            this.options_categorias = res.data;
        }).
        catch(error => {
            console.error('Hove um erro ao tentar buscar as categorias.');
            console.error(error);
        });
    }
}
</script>

// Style -----------------------------------------------------
<style lang="stylus" scoped>

</style>