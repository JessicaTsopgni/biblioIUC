import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { DashboardComponent } from './pages/dashboard/dashboard.component';
import { CategoryEditComponent } from './pages/categories/category-edit/category-edit.component';
import { CategoryListComponent } from './pages/categories/category-list/category-list.component';
import { CategoryDetailComponent } from './pages/categories/category-detail/category-detail.component';


const routes: Routes = [
  { path: '', redirectTo: 'dashboard', pathMatch: 'full' },
  { path: 'dashboard', component: DashboardComponent },
  { path: 'category/edit', component: CategoryEditComponent },
  { path: 'category/list', component: CategoryListComponent },
  { path: 'category/detail', component: CategoryDetailComponent }
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
