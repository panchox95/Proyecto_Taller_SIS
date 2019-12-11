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
import { ServicioNewComponent } from './components/servicio-new/servicio-new.component';
import { ServicioListComponent } from './components/servicio-list/servicio-list.component';
import { ServicioDetailComponent } from './components/servicio-detail/servicio-detail.component';
import { ServicioEditComponent } from './components/servicio-edit/servicio-edit.component';
import { ComentarioservicioNewComponent } from './components/comentarioservicio-new/comentarioservicio-new.component';
import { OfertaServicioNewComponent } from './components/ofertaservicio-new/ofertaservicio-new.component';
import { OfertaservicioDetailComponent } from './components/ofertaservicio-detail/ofertaservicio-detail.component';
import { CarritoListComponent } from './components/carrito-list/carrito-list.component';
import {
  SocialLoginModule,
  AuthServiceConfig,
  GoogleLoginProvider,
  FacebookLoginProvider,
} from "angular-6-social-login";
import { BusquedaRangoComponent } from './components/busqueda-rango/busqueda-rango.component';
import { CheckoutComponent } from './components/checkout/checkout.component';

export function getAuthServiceConfigs() {
  let config = new AuthServiceConfig(
    [
      {
        id: FacebookLoginProvider.PROVIDER_ID,
        provider: new FacebookLoginProvider("581488765929996")
      },
      {
        id: GoogleLoginProvider.PROVIDER_ID,
        provider: new GoogleLoginProvider("961539498024-cdvjqn6lk2en4k3e405ihbk2k6c2l1th.apps.googleusercontent.com")
      }]
);
  return config;
}

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
      ComentarioNewComponent,
      ServicioNewComponent,
      ServicioListComponent,
      ServicioDetailComponent,
      ServicioEditComponent,
      ComentarioservicioNewComponent,
      OfertaServicioNewComponent,
      OfertaservicioDetailComponent,
      CarritoListComponent,
      BusquedaRangoComponent,
      CheckoutComponent
  ],
  imports: [
      BrowserModule,
      AppRoutingModule,
      FormsModule,
      routing,
      HttpClientModule,
      FontAwesomeModule,
      SocialLoginModule
  ],
  providers: [
      appRoutingProviders,
    {
      provide: AuthServiceConfig,
      useFactory: getAuthServiceConfigs
    },
  ],
  bootstrap: [AppComponent]
})
export class AppModule { }
