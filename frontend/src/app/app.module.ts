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
      PerfilComponent
  ],
  imports: [
      BrowserModule,
      AppRoutingModule,
      FormsModule,
      routing,
      HttpClientModule
  ],
  providers: [
      appRoutingProviders
  ],
  bootstrap: [AppComponent]
})
export class AppModule { }
