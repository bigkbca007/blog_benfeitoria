<template>
    <div>
        <fieldset>
            <h3>Adicionar</h3>
            <div class="field">
                <label class="label" for="titulo">Título</label>
                <div class="control">
                    <input v-model="post.titulo" class="input" type="text" id="titulo" placeholder="Título">
                </div>
            </div>

            <div class="field">
                <label class="label" for="img_post">Imagem do Post</label>
                <div class="file">

                    <label class="file-label">
                        <input
                            class="file-input"
                            type="file"
                            @change="onFileSelected"                          
                        >
                        <span class="file-cta">
                        <span class="file-icon">
                        <i class="fas fa-upload"></i>
                        </span>
                            <span class="file-label">
                                Escolha um arquivo…
                            </span>
                        </span>
                    </label>

                </div>

            </div>

            <div class="field">
                <label class="label" for="conteudo">Conteúdo</label>
                <div class="control">
                    <textarea v-model="post.conteudo" class="textarea" placeholder="Textarea"></textarea>
                </div>
            </div>

            <div class="field">
                <label class="label">Categoria</label>
                <div class="control">
                    <div class="select">
                        <v-select
                            :options="options_categorias"
                            :reduce="nome => nome.id"
                            label="nome"
                            v-model="post.categoria_id"
                        />

                    </div>
                </div>
            </div>
    
            <div class="field is-grouped">
                <div class="control">
                    <button @click="postar" class="button is-link">Postar</button>
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
                
                <!-- Lista de posts -->
                <posts-itens-list :items="items" :remover="remover" v-on:recarregarLista="buscar"/>
            </div>
        </fieldset>

    </div>
</template>

// Javascript ------------------------------------------------
<script>

import postsItensList from './postsItensList';

export default {
    components:{
        postsItensList
    },
    data: function(){
        return {
            post: {
                titulo: "",
                img_post: {},
                conteudo: "",
                categoria_id: ""
            },
            options_categorias: [],
            termos: "",
            items: [],
            remover: 1
        }
    },
    created: function(){

        axios.get('/categorias/getOptions')
        .then(res => {
            this.options_categorias = res.data;
        }).
        catch(error => {
            console.error('Hove um erro ao tentar buscar as categorias.');
            console.error(error);
        });

    },
    methods:{
        postar: function(){
            const formData = new FormData();
            formData.append('post[titulo]', this.post.titulo);
            formData.append('img_post', this.post.img_post);
            formData.append('post[conteudo]', this.post.conteudo);
            formData.append('post[categoria_id]', this.post.categoria_id);
                        
            axios.post('/posts/store', formData)
                .then(res => {
                    this.post.titulo = "";
                    this.post.img_post = {};
                    this.post.conteudo = "";
                    this.post.categoria_id = "";

                    // Se já estiver listando para exclusão, então recarega a lista.
                    if(this.items.length > 0){
                        this.buscar();
                    }
                });
        },
        onFileSelected(event){
            this.post.img_post = event.target.files[0]
        },
        buscar: function(){
            axios.get('/posts/buscar', {
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