import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { DashboardComponent } from './pages/dashboard/dashboard.component';
import { CategorieEditComponent } from './pages/categorie-edit/categorie-edit.component';
import { CategorieListComponent } from './pages/categorie-list/categorie-list.component';
import { CategorieDetailComponent } from './pages/categorie-detail/categorie-detail.component';


const routes: Routes = [
  {path:'', redirectTo:'dashboard', pathMatch:'full'},
  {path:'dashboard', component: DashboardComponent},
  {path:'categorie/edit', component: CategorieEditComponent},  
  {path:'categorie/list', component: CategorieListComponent},    
  {path:'categorie/detail', component: CategorieDetailComponent}
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
