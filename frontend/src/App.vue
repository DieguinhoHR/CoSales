<template>
  <div class='container'>
    <h1>Listagem de contatos</h1>
    <table class='table table-striped'>
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Nome do vendedor</th>
          <th scope="col">Nome do contato</th>
          <th scope="col">Telefone</th>
          <th scope="col">E-mail</th>
          <th scope="col">Opções</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="contact of contacts" :key="contact.id">
          <th scope="row">{{ contact.id }}</th>
          <td>{{ contact.salesman_name }}</td>
          <td>{{ contact.contact_name }}</td>
          <td>{{ contact.phone }}</td>
          <td>{{ contact.email }}</td>
          <td>
            <button 
              @click="update(contact)" 
              type="button" 
              class="btn btn-warning"
            >
                Atualizar
            </button>&nbsp;

            <button
              @click="deleteContact(contact)"
              type="button" 
              class="btn btn-danger"
            >
              Deletar
            </button>
          </td>  
        </tr>      
      </tbody>  
    </table>

    <h2>Cadastrar contato</h2>
    <hr />

    <div v-if="hasError === true" class="alert alert-danger" role="alert">
      <ul>
        <li v-for="(error, index) of errors" :key="index">
          campo <b>{{ error }}</b>
        </li>
      </ul>
    </div>

    <form @submit.prevent="save">
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="inputNomeDoVendedor">Nome do vendedor</label>
          <input 
            type="text" 
            class="form-control" 
            placeholder="Digite o nome do vendedor"
            v-model="contact.salesmanName"
          >
        </div>

        <div class="form-group col-md-6">
          <label for="inputNomeDaEmpresa">Nome da empresa</label>
          <input 
            type="text" 
            class="form-control" 
            placeholder="Digite o nome da empresa"
            v-model="contact.enterpriseName"
          >
        </div>
      </div>

      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="inputNomeDoContato">Nome do contato</label>
          <input 
            type="text" 
            class="form-control"
            placeholder="Digite o nome do contato"
            v-model="contact.contactName">
        </div>
        
        <div class="form-group col-md-6">
          <label for="inputEmail">E-mail</label>
          <input 
            type="email" 
            class="form-control" 
            placeholder="Digite o e-mail"
            v-model="contact.email">
        </div>
      </div>

      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="inputTelefone">Telefone</label>
          <input 
            type="text" 
            class="form-control"
            value="Um"
            placeholder="Digite o telefone"
            v-model="contact.phone"
          >
        </div>
        
        <div class="form-group col-md-6">
          <label for="inputDataDeContato">Data de contato</label>
          <input 
            type="date" 
            class="form-control" 
            placeholder="Digite a data de contato"
            v-model="contact.contactDate"
          >
        </div>
      </div>  

      <div class="form-row">        
        <div class="form-group col-md-6">
          <label for="inputDataDeContato">Data de validade</label>
          <input 
            type="date" 
            class="form-control" 
            placeholder="Digite a data de validade"
            v-model="contact.validateDate"
          >
        </div>          
      </div>  
      <button type="submit" class="btn btn-primary">Salvar</button>
    </form>
  </div>
</template>

<script>
import api from './services/api'
const moment = require('moment')

export default {
  data () {
    return {
      contact: {
        id: '',
        salesmanName: '',
        enterpriseName: '',
        contactName: '',
        email: '',
        phone: '',
        contactDate: '',
        validateDate: ''
      },
      contacts: [],
      errors: [],
      hasError: false
    }
  },

  mounted () {
    this.list()
  },

  methods: {
    list () {
      return api.get('contacts').then(response => {
        this.contacts = response.data
      })
    },

    save () {
      const actualDate = moment().format('L');

      if (this.contact.contactDate > actualDate) {
        alert('A data de contato não pode ser maior que a data de hoje')

        return
      }

      if (!this.contact.id) {
        return api.post('contacts', {
          salesman_name: this.contact.salesmanName,
          enterprise_name: this.contact.enterpriseName,
          contact_name: this.contact.contactName,
          email: this.contact.email,
          phone: this.contact.phone,
          contact_date: this.contact.contactDate,
          validate_date: this.contact.validateDate
        })
        .then(() => {
          this.contact = {}
          
          alert('Registro inserido com sucesso')

          this.errors = []
          this.list()
        })
        .catch(error => {
          this.hasError = true
          this.errors = error.response.data.errors
        })
      }
            
      return api.put('contacts/' + this.contact.id, {
          salesman_name: this.contact.salesmanName,
          enterprise_name: this.contact.enterpriseName,
          contact_name: this.contact.contactName,
          email: this.contact.email,
          phone: this.contact.phone,
          contact_date: this.contact.contactDate,
          validate_date: this.contact.validateDate
        })
        .then(() => {
          this.contact = {}
          
          alert('Registro atualizado com sucesso')

          this.errors = []
          this.list()
        })
        .catch(error => {
          this.hasError = true
          this.errors = error.response.data.errors
        })
    },

    update (contact) {
      this.contact = {
        id: contact.id,
        salesmanName: contact.salesman_name,
        enterpriseName: contact.enterprise_name,
        contactName: contact.contact_name,
        email: contact.email,
        phone: contact.phone,
        contactDate: contact.contact_date,
        validateDate: contact.validate_date
      }      
    },

    deleteContact (contact) {
      if (confirm('Deseja excluir este registro?')) {
        return api.delete('contacts/' + contact.id, { data: contact })
          .then(() => {
            alert('Registro excluido com sucesso')

            this.list()
          })
          .catch(error => {
            console.log(error)
          }) 
      }  
    }
  } 
}
</script>

<style>
  .container {
    padding-top: 17px;
  }
</style>
