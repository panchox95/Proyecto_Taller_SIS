import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { ModuleWithProviders} from '@angular/compiler/src/core';
import { LoginComponent } from './components/login/login.component';
import { RegisterComponent } from './components/register/register.component';
import { DefaultComponent } from './components/default/default.component';


const appRoutes: Routes = [
    { path: '', component: DefaultComponent },
    //{ path: '', component: LoginComponent },
    { path: 'home', component: DefaultComponent },
    { path: 'login', component: LoginComponent },
    { path: 'logout/:sure',component: LoginComponent },
    { path: 'register', component: RegisterComponent },
    { path: '**', component: DefaultComponent },
];

export const appRoutingProviders: any[] = [];
export const routing: ModuleWithProviders = RouterModule.forRoot(appRoutes);

@NgModule({
  imports: [RouterModule.forRoot(appRoutes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
