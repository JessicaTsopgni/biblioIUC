import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { AppSettings } from '../app.settings';


@Injectable({
  providedIn: 'root'
})
export class BaseService {


  constructor(private http: HttpClient, private appService: AppSettings) { }

  get(url: string) {
    return this.http.get(`${this.appService.baseUrl}${url}`);
  }

  post(url: string, data: any) {
    return this.http.post(`${this.appService.baseUrl}${url}`, data);
  }

  put(url: string, data: any) {
    return this.http.put(`${this.appService.baseUrl}${url}`, data);
  }

  delete(url: string) {
    return this.http.delete(`${this.appService.baseUrl}${url}`);
  }

  
  convertToFormData(data, formData, parentKey) {
    if(data === null || data === undefined) return null;
  
    formData = formData || new FormData();
  
    if (typeof data === 'object' && !(data instanceof Date) && !(data instanceof File)) {
      Object.keys(data).forEach(key => 
        this.convertToFormData(data[key], formData, (!parentKey ? key : (data[key] instanceof File ? parentKey : `${parentKey}[${key}]`)))
      );
    } else {
      formData.append(parentKey, data);          
    }
    return formData;
  }
}