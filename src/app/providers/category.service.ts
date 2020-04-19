import { Injectable } from '@angular/core';
import { BaseService } from './base.service';
import { CategoryModel } from '../models/category.model';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class CategoryService {

  constructor(private baseService:BaseService) { }

  add(category:CategoryModel) {
    let data = this.baseService.convertToFormData(category, null, null);
    return this.baseService.post('/categories/add.php', data);
  }
}
