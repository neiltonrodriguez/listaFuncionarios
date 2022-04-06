<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.0/axios.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    
</head>
<body>
<div id="app">
  <div class="container-sm mt-3">
  <button @click="abrirModal()" type="button" class="btn btn-primary">Novo Funcinário</button>
    <table class="table">
      <thead>
        <th>COD</th>
        <th>NOME</th>
        <th>E-MAIL</th>
        <th>FUNÇÃO</th>
        <th>AÇÕES</th>
       
      </thead>
      <tbody>
        
        <tr v-for="f in funcionarios">
          <td>@{{ f.id }}</td>
          <td>@{{ f.nome }}</td>
          <td>@{{ f.email }}</td>
          <td v-for="x in funcoes" v-if="x.id == f.funcionalidade_id">@{{ x.nome }}</td>
          <td>
            <button type="button" @click="abrirModal(f)" class="btn btn-success">edit</button>
            <button type="button" @click="deleteFunc(f.id)" class="btn btn-danger">delete</button>
          </td>
        </tr>
        
      </tbody>
    </table>
  </div>



  @include('funcionarios.cadastrarFunc')
</div>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
<script>
    const vm = new Vue({
        el: '#app',
        data: {
            funcionarios: {},
            funcoes: {},
            form: {}
        },
        
        mounted() {
            this.getFunc();
          
        },
        methods: {
            getFunc() {
              axios.get("{{ route('funcionariosGet') }}").then((resp) => {
                    this.funcionarios = resp.data['funcionarios'];
                    this.funcoes = resp.data['funcao'];
                    
                })
                
            },
            async deleteFunc(id){
              if (confirm("Deseja excluir?")) {
              await axios.get('funcionarios/delete/' + id).then((r) => {
                this.getFunc();
                Swal.fire({
                            
                            icon: r.data.icon,
                            title: r.data.msg,
                            showConfirmButton: false,
                            timer: 1500
                        })
              })
            }
            },
            async salvarFunc() {
                await axios.post("{{ route('funcionariosSalvar') }}", this.form)
                    .then((r) => {
                      if (!r.data.error) {
                          this.getFunc();
                            
                       }
                       Swal.fire({
                            
                            icon: r.data.icon,
                            title: r.data.msg,
                            showConfirmButton: false,
                            timer: 1500
                        })
                        
                    }).catch((e) => {
                        console.log(e)
                    });
            },
            abrirModal(dados = null) {
                this.form = {};
                if (dados !== null)
                    this.form = dados;
                $("#cadastrarFuncionarios").modal('show');
            }
            
            
        }

    })
</script>

</body>
</html>
