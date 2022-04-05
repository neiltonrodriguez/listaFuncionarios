<div class="modal fade" id="cadastrarFuncionarios" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Funcionário</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Nome</label>
                        <input v-model="form.nome" type="text" class="form-control" id="exampleFormControlInput1" placeholder="seu nome aqui">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Email</label>
                        <input v-model="form.email" type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
                    </div>
                    <select class="form-select" v-model="form.funcionalidade_id" aria-label="Default select example">
                        @foreach($func as $f)
                        <option value="{{ $f->id }}">{{ $f->nome }}</option>
                        @endforeach
                    </select>



                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                        <button type="button" @click="salvarFunc()" class="btn btn-primary">Salvar</button>
                    </div>
                </form>
        </div>
    </div>
</div>