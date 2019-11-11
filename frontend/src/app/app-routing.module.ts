// @ts-ignore
import { NgModule } from '@angular/core';
// @ts-ignore
import { Routes, RouterModule } from '@angular/router';
// @ts-ignore
import { ModuleWithProviders} from '@angular/compiler/src/core';
import { LoginComponent } from './components/login/login.component';
import { RegisterComponent } from './components/register/register.component';
import { DefaultComponent } from './components/default/default.component';
import { ArticuloNewComponent } from './components/articulo-new/articulo-new.component';
import { ArticuloEditComponent } from './components/articulo-edit/articulo-edit.component';
import { ArticuloDetailComponent } from './components/articulo-detail/articulo-detail.component';
import { ArticuloListComponent } from './components/articulo-list/articulo-list.component';
import { PerfilComponent } from './components/perfil/perfil.component';
import { PerfilEditComponent } from './components/perfil-edit/perfil-edit.component';
import { ArticuloBusquedaComponent } from './components/articulo-busqueda/articulo-busqueda.component';
import { OfertaNewComponent } from './components/oferta-new/oferta-new.component';
import { ComentarioNewComponent } from './components/comentario-new/comentario-new.component';
import { ServicioNewComponent } from './components/servicio-new/servicio-new.component';
import { ServicioListComponent } from './components/servicio-list/servicio-list.component';
import { ServicioDetailComponent } from './components/servicio-detail/servicio-detail.component';
import { ServicioEditComponent } from './components/servicio-edit/servicio-edit.component';
import { ComentarioservicioNewComponent } from './components/comentarioservicio-new/comentarioservicio-new.component';

const appRoutes: Routes = [
    { path: '', component: DefaultComponent },
    //{ path: '', component: LoginComponent },
    { path: 'home', component: DefaultComponent },
    { path: 'login', component: LoginComponent },
    { path: 'logout/:sure',component: LoginComponent },
    { path: 'register', component: RegisterComponent },
    { path: 'crear-articulo', component: ArticuloNewComponent },
    { path: 'lista-articulo', component: ArticuloListComponent },
    { path: 'editar-articulo/:id_producto',component: ArticuloEditComponent },
    { path: 'articulo/:id_producto', component: ArticuloDetailComponent },
    { path: 'perfil', component: PerfilComponent },
    { path: 'listaproducto/:page',component:ArticuloListComponent},
    { path: 'editar-perfil',component: PerfilEditComponent},
    { path: 'uploadimage',component: PerfilComponent},
    { path: 'busqueda-articulo', component: ArticuloBusquedaComponent },
    { path: 'busqueda', component: ArticuloBusquedaComponent },
    { path: 'oferta/:id_producto', component: OfertaNewComponent },
    { path: 'comentario/:id_producto', component: ComentarioNewComponent },
    { path: 'crear-servicio', component: ServicioNewComponent },
    { path: 'lista-servicio', component: ServicioListComponent },
    { path: 'servicio/:id_servicio', component: ServicioDetailComponent },
    { path: 'editar-servicio/:id_servicio',component: ServicioEditComponent },
    { path: 'comentarioservicio/:id_servicio', component: ComentarioservicioNewComponent },


    // Este siempre tiene q ser el ultimo
    { path: '**', component: DefaultComponent },
    
];

export const appRoutingProviders: any[] = [];
export const routing: ModuleWithProviders = RouterModule.forRoot(appRoutes);

// @ts-ignore
@NgModule({
  imports: [RouterModule.forRoot(appRoutes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
