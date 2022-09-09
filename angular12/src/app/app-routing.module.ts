import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { CompaniesComponent } from './companies/companies.component';
import { UserComponent } from './user/user.component';

const routes: Routes = [
  { path: '', component: UserComponent, pathMatch: 'full' },
  { path: 'companies', component: CompaniesComponent },
  { path: '**', redirectTo: '', pathMatch: 'full' }
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
