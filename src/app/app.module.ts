import { BrowserModule, Title } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { HttpClientModule } from '@angular/common/http';
import { AppRoutingModule } from './app-routing.module';

import { AppComponent } from './app.component';
import { DashboardComponent } from './pages/dashboard/dashboard.component';
import { CategoryEditComponent } from './pages/categories/category-edit/category-edit.component';
import { CategoryListComponent } from './pages/categories/category-list/category-list.component';
import { CategoryDetailComponent } from './pages/categories/category-detail/category-detail.component';
import { EnableDisablePipe } from './common/EnableDisablePipe';

@NgModule({
  declarations: [
    EnableDisablePipe,
    AppComponent,
    DashboardComponent,
    CategoryEditComponent,
    CategoryListComponent,
    CategoryDetailComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    FormsModule,
    HttpClientModule
  ],
  providers: [
    Title
  ],
  bootstrap: [AppComponent]
})
export class AppModule { }
