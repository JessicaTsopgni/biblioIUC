import { Injectable } from '@angular/core';
import { BaseService } from './base.service';
import { CategoryModel } from '../models/category.model';

@Injectable({
  providedIn: 'root'
})
export class CategoryService {

  constructor(private baseService:BaseService) { }

  add(category:CategoryModel) {
    let data = this.baseService.convertToFormData(category, null, null);
    return this.baseService.post('/categories/add.php', data)
    .subscribe(
      data => console.log('success', data),
      error => console.log('error', error)
    );
  }
}
