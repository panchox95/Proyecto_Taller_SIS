import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { FormsModule} from '@angular/forms';
import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { LoginComponent } from './components/login/login.component';
import { RegisterComponent } from './components/register/register.component';
import { routing, appRoutingProviders } from './app-routing.module';
import { HttpClientModule } from '@angular/common/http';
import { DefaultComponent } from './components/default/default.component';
import { ArticuloNewComponent } from './components/articulo-new/articulo-new.component';
import { ArticuloEditComponent } from './components/articulo-edit/articulo-edit.component';
import { ArticuloDetailComponent } from './components/articulo-detail/articulo-detail.component';

@NgModule({
  declarations: [
    AppComponent,
    LoginComponent,
    RegisterComponent,
      DefaultComponent,
      ArticuloNewComponent,
      ArticuloEditComponent,
      ArticuloDetailComponent
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
