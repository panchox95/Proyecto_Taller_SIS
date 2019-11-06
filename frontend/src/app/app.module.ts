// @ts-ignore
import { BrowserModule } from '@angular/platform-browser';
// @ts-ignore
import { NgModule } from '@angular/core';
// @ts-ignore
import { FormsModule} from '@angular/forms';
import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { LoginComponent } from './components/login/login.component';
import { RegisterComponent } from './components/register/register.component';
import { routing, appRoutingProviders } from './app-routing.module';
// @ts-ignore
import { HttpClientModule } from '@angular/common/http';
import { DefaultComponent } from './components/default/default.component';
import { ArticuloNewComponent } from './components/articulo-new/articulo-new.component';
import { ArticuloEditComponent } from './components/articulo-edit/articulo-edit.component';
import { ArticuloDetailComponent } from './components/articulo-detail/articulo-detail.component';
import { PerfilComponent } from './components/perfil/perfil.component';
import { OfertaDetailComponent } from './components/oferta-detail/oferta-detail.component';
import { ArticuloListComponent } from './components/articulo-list/articulo-list.component';
import { PerfilEditComponent } from './components/perfil-edit/perfil-edit.component';
import { ArticuloBusquedaComponent } from './components/articulo-busqueda/articulo-busqueda.component';
import { OfertaNewComponent } from './components/oferta-new/oferta-new.component';
import { ComentarioNewComponent } from './components/comentario-new/comentario-new.component';
import { FontAwesomeModule } from '@fortawesome/angular-fontawesome';


// @ts-ignore
@NgModule({
  declarations: [
    AppComponent,
    LoginComponent,
    RegisterComponent,
      DefaultComponent,
      ArticuloNewComponent,
      ArticuloEditComponent,
      ArticuloDetailComponent,
      PerfilComponent,
      OfertaDetailComponent,
      ArticuloListComponent,
      PerfilEditComponent,
      ArticuloBusquedaComponent,
      OfertaNewComponent,
      ComentarioNewComponent
  ],
  imports: [
      BrowserModule,
      AppRoutingModule,
      FormsModule,
      routing,
      HttpClientModule,
      FontAwesomeModule
  ],
  providers: [
      appRoutingProviders
  ],
  bootstrap: [AppComponent]
})
export class AppModule { }
