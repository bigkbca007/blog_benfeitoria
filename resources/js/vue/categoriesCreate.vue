<template>
    <div>
        <fieldset>
            <h3>Adicionar</h3>
            <div class="field">
                <label class="label" for="nome">Nome</label>
                <div class="control">
                    <input v-model="categoria.nome" class="input" type="text" id="nome" placeholder="Nome">
                </div>
            </div>
            <div class="field is-grouped">
                <div class="control">
                    <button @click="cadastrar" class="button is-link">Cadastrar</button>
                </div>
            </div>
        </fieldset>

        <hr>

        <fieldset>
            <h3>Deletar</h3>
            <div class="field has-addons">
                <div class="control">
                    <input v-model="termos" class="input" type="text" placeholder="Digite os termos para a busca.">
                </div>
                <div class="control">
                    <a @click="buscar" class="button is-info">
                        Buscar
                    </a>
                </div>
                
                <!-- Lista de categorias -->
                <categories-itens-list :items="items" :remover="remover" v-on:recarregarLista="buscar"/>
            </div>
        </fieldset>
        
    </div>
</template>

// Javascript ------------------------------------------------
<script>

import categoriesItensList from './categoriesItensList';

export default {
    components:{
        categoriesItensList
    },
    data: function(){
        return {
            categoria: {
                "nome": "",
            },
            termos: "",
            items: [],
            remover: 1
        }
    },
    methods:{
        cadastrar: function(){
            axios.post('/categorias/store', {
                categoria: this.categoria
            }).then(res => {
                this.categoria.nome = '';

                // Se já estiver listando para exclusão, então recarega a lista.
                if(this.items.length > 0){
                    this.buscar();
                }
            })
            .catch(error => {
                console.log(error);
            });
        },
        buscar: function(){
            axios.get('/categorias/buscar', {
                params: {
                    termos: this.termos
                }
            }).then(res => {
                this.items = res.data;
            });
        },
    }
}
</script>

// Style -----------------------------------------------------
<style lang="stylus" scoped>

</style>