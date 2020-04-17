import { BrowserModule, Title } from '@angular/platform-browser';
import { NgModule } from '@angular/core';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { DashboardComponent } from './pages/dashboard/dashboard.component';
import { CategorieEditComponent } from './pages/categorie-edit/categorie-edit.component';
import { CategorieListComponent } from './pages/categorie-list/categorie-list.component';
import { CategorieDetailComponent } from './pages/categorie-detail/categorie-detail.component';

@NgModule({
  declarations: [
    AppComponent,
    DashboardComponent,
    CategorieEditComponent,
    CategorieListComponent,
    CategorieDetailComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule
  ],
  providers: [
    Title
  ],
  bootstrap: [AppComponent]
})
export class AppModule { }
