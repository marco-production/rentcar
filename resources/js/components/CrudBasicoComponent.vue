<template>
<div>
    <div class="alert bg-green alert-dismissible" v-if="showAlert" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        {{textAlert}}
    </div>
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2 class="text-uppercase" v-if="modoCrearItem">Registrar {{model_name}}</h2>
                    <h2 class="text-uppercase" v-else>Editar {{model_name}}</h2>
                </div>
                <div class="body">
                    <form @submit.prevent="postData" method="POST" v-if="modoCrearItem">
                        <div class="row clearfix">
                            <div class="col-md-6">
                                <b>Nombre</b>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">reorder</i>
                                    </span>
                                    <div class="form-line" v-bind:class="[!errors.has('nombre') ? hasError: 'error focused', isActive]">
                                        <input type="text" name="nombre" class="form-control" v-validate="'required|alpha_spaces|max:40'" v-model="myData.name" placeholder="Ingresa nombre">
                                    </div>
                                    <span v-show="errors.has('nombre')" class="invalid-feedback" style="color:#dc3545; font-size:12px;" role="alert">
                                        <strong>{{ errors.first('nombre') }}</strong>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <b>Estado</b>
                                <div class="input-group">
                                    <div class="demo-radio-button">
                                        <input name="estado" v-model="myData.estado" v-validate="'required'" value="1" type="radio" class="with-gap" id="radio_1" />
                                        <label for="radio_1">Activo</label>
                                        <input name="estado" v-model="myData.estado" type="radio" id="radio_2" value="0" class="with-gap" />
                                        <label for="radio_2">Inactivo</label>
                                    </div>
                                    <span v-show="errors.has('estado')" class="invalid-feedback" style="color:#dc3545; font-size:12px;" role="alert">
                                        <strong>{{ errors.first('estado') }}</strong>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-md-12" style="margin-bottom:0px;">
                                <b>Descripcion</b>
                                <div class="input-group">
                                    <div class="form-line" v-bind:class="[!errors.has('descripcion') ? hasError: 'error focused', isActive]">
                                        <input type="text" v-model="myData.descripcion" v-validate="'required|max:574'" class="form-control" name="descripcion" value="" placeholder="Ingresa la descripción del tipo de vehiculo">
                                    </div>
                                    <span v-show="errors.has('descripcion')" class="invalid-feedback" style="color:#dc3545; font-size:12px;" role="alert">
                                        <strong>{{ errors.first('descripcion') }}</strong>
                                    </span>
                                    <button type="submit" style="float: right; margin-top: 15px;" class="btn btn-success btn-lg m-l-15 waves-effect">+ AGREGAR</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <form @submit.prevent="updateData(myData)" method="POST" v-else>
                        <div class="row clearfix">
                            <div class="col-md-6">
                                <b>Nombre</b>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">reorder</i>
                                    </span>
                                    <div class="form-line" v-bind:class="[!errors.has('nombre') ? hasError: 'error focused', isActive]">
                                        <input type="text" class="form-control" name="nombre" v-model="myData.name" v-validate="'required|alpha_spaces|max:40'" placeholder="Ingresa nombre">
                                    </div>
                                    <span v-show="errors.has('nombre')" class="invalid-feedback" style="color:#dc3545; font-size:12px;" role="alert">
                                        <strong>{{ errors.first('nombre') }}</strong>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <b>Estado</b>
                                <div class="input-group">
                                    <div class="demo-radio-button">
                                        <input name="estado" v-model="myData.estado" v-if="myData.estado == 1" checked value="1" type="radio" class="with-gap" id="radio_1" />
                                        <input name="estado" v-model="myData.estado" v-else value="1" type="radio" class="with-gap" id="radio_1" />
                                        <label for="radio_1">Activo</label>
                                        <input name="estado" v-model="myData.estado" v-if="myData.estado == 0" checked type="radio" id="radio_2" value="0" class="with-gap" />
                                        <input name="estado" v-model="myData.estado" v-else type="radio" id="radio_2" value="0" class="with-gap" />
                                        <label for="radio_2">Inactivo</label>
                                    </div>
                                    <span v-show="errors.has('estado')" class="invalid-feedback" style="color:#dc3545; font-size:12px;" role="alert">
                                        <strong>{{ errors.first('estado') }}</strong>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-md-12" style="margin-bottom:0px;">
                                <b>Descripcion</b>
                                <div class="input-group">
                                    <div class="form-line" v-bind:class="[!errors.has('descripcion') ? hasError: 'error focused', isActive]">
                                        <input type="text" v-model="myData.descripcion" class="form-control" v-validate="'required|max:574'" name="descripcion" value="" placeholder="Ingresa la descripción del tipo de vehiculo">
                                    </div>
                                    <span v-show="errors.has('descripcion')" class="invalid-feedback" style="color:#dc3545; font-size:12px;" role="alert">
                                        <strong>{{ errors.first('descripcion') }}</strong>
                                    </span>
                                    <button type="submit" style="float: right; margin-top: 15px;" class="btn btn-success btn-lg m-l-15 waves-effect">ACTUALIZAR</button>
                                    <button @click="cancelUpdate(true)" type="button" style="float: right; margin-top: 15px;" class="btn btn-default btn-lg m-l-15 waves-effect">CANCELAR</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="block-header">
        <h2 class="text-uppercase">Listado de {{model_name}}</h2>
    </div>
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="body table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>NOMBRE</th>
                                <th>DESCRIPCION</th>
                                <th>ESTADOS</th>
                                <th>ACCIONES</th>
                            </tr>
                        </thead>
                        <tbody v-for="(item, index) in Items" :key="index">
                            <tr>
                                <th scope="row">{{item.id}}</th>
                                <td>{{item.name}}</td>
                                <td>{{item.descripcion.substr(0,44)}}<span v-if="item.descripcion.length > 44">...</span></td>
                                <td><span v-if="item.estado == 1">Activo</span><span v-else>Inactivo</span></td>
                                <td>
                                    <div class="icon-button-demo">
                                        <label class="btn bg-blue waves-effect" @click="showData(item)" data-toggle="modal" data-target="#dataModal"><svg id="i-eye" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" width="17" height="17" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                            <circle cx="17" cy="15" r="1" />
                                            <circle cx="16" cy="16" r="6" />
                                            <path d="M2 16 C2 16 7 6 16 6 25 6 30 16 30 16 30 16 25 26 16 26 7 26 2 16 2 16 Z" />
                                        </svg></label>
                                        <label @click="editData(item)" class="btn bg-amber waves-effect label-up"><svg id="i-edit" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" width="17" height="17" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                            <path d="M30 7 L25 2 5 22 3 29 10 27 Z M21 6 L26 11 Z M5 22 L10 27 Z" />
                                        </svg></label>
                                        <form action="" method="POST" style="display: contents;">
                                        <label @click="deleteDate(item,index)" class="btn bg-red waves-effect"><svg id="i-trash" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" width="17" height="17" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                            <path d="M28 6 L6 6 8 30 24 30 26 6 4 6 M16 12 L16 24 M21 12 L20 24 M11 12 L12 24 M12 6 L13 2 19 2 20 6" />
                                        </svg></label>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="dataModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="largeModalLabel"></h4>
                </div>
                <div class="modal-body" id="dataDescription"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CERRAR</button>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import axios from 'axios';
import JQuery from 'jquery';
let $ = JQuery;
import { Validator } from 'vee-validate';

export default {
    data() {
        return {
            Items:[],
            modoCrearItem:true,
            myData: {name:'', descripcion:'', estado:''},
            isActive: '',
            hasError: '',
            DbName: null,
            showAlert:false,
            textAlert:'',
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        }
    },
    props:['api_url','model_name','genero'],
    created() {
        this.getData();
    },
    methods: {
        getData(){
            axios.get(this.api_url)
            .then(res=>{
                this.Items = res.data;
            })
            .catch((err)=>{
                console.log(err);
            });
        },
        postData(){
            this.$validator.validateAll().then((result) => {
                if (result) {
                    this.$validator.pause();
                    let param = {name: this.myData.name, descripcion: this.myData.descripcion, estado: this.myData.estado}
                    
                    this.cancelUpdate(true);

                    axios.post(this.api_url, param, { headers: { 'x-csrf-token': this.csrf }})
                    .then((res)=>{
                        this.Items.push(res.data);
                        this.textAlert = `${this.genero} ${this.model_name} ${res.data.name} ha sido añadido exitosamente!!`;
                        this.showAlert = true;
                    })
                    .catch((err)=>{
                        console.log(err);
                    });
                    this.$nextTick(() => {
                        this.$validator.reset();
                        this.$validator.resume();
                    });
                    return;
                }
            });
        },
        editData(data){
            this.$validator.pause();
            this.myData.id = data.id;
            this.myData.name = data.name;
            this.myData.descripcion = data.descripcion;
            this.myData.estado = data.estado;
            this.modoCrearItem = false;    
            this.showAlert = false; 
            this.$nextTick(() => {
                this.$validator.reset();
                this.$validator.resume();
            });      
        },
        updateData(data){
            this.$validator.validateAll().then((result) => {
                if (result) {
                    this.$validator.pause();
                    let param = {name: data.name, descripcion: data.descripcion, estado: data.estado}

                    axios.put(`${this.api_url}/${data.id}`, param, { headers: { 'x-csrf-token': this.csrf }})
                    .then((res)=>{
                        this.cancelUpdate(true);
                        let index = this.Items.findIndex(laNota => laNota.id == data.id);
                        this.Items[index] = res.data;
                        this.showAlert = true;
                        this.textAlert = `${this.genero} ${this.model_name} #${data.id} ha sido actualizado exitosamente!!`;
                    })
                    .catch((err)=>{
                        console.log(err);
                    });
                    this.$nextTick(() => {
                        this.$validator.reset();
                        this.$validator.resume();
                    });
                    return;
                }
            });
        },
        deleteDate(data,index){
            this.showAlert = false;
            this.cancelUpdate(true);
            if(confirm(`¿Desea eliminar la tarea ${data.name}?`)){
                axios.delete(`${this.api_url}/${data.slug}`, { headers: { 'x-csrf-token': this.csrf }})
                .then((res)=>{
                    this.Items.splice(index,1);
                    this.showAlert = true;
                    this.textAlert = `${this.genero} ${this.model_name} ${data.name} ha sido eliminado exitosamente!!`;
                })
                .catch((err)=>{
                    console.log(err);
                });
                return;
            }
            return;
        },
        showData(data){
            this.showAlert = false;
            $('#largeModalLabel').html(`Detalle de ${this.model_name} - ${data.name}`);
            $('#dataDescription').html(data.descripcion);
        },
        cancelUpdate(value){
            this.$validator.reset();
            this.myData = {name:'', descripcion:'', estado:''};
            this.modoCrearItem = value;
        },
    },
}
</script>
