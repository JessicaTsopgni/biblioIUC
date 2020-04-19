import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { AppSettings } from '../app.settings';
import { Observable } from 'rxjs';
import { JsonObject } from '../models/json-object.model';


@Injectable({
  providedIn: 'root'
})
export class BaseService {


  constructor(private http: HttpClient, private appService: AppSettings) { }

  get(url: string):Observable<JsonObject> {
    return this.http.get<JsonObject>(`${this.appService.baseUrl}${url}`);
  }

  post(url: string, data: any):Observable<JsonObject> {
    return this.http.post<JsonObject>(`${this.appService.baseUrl}${url}`, data);
  }

  put(url: string, data: any):Observable<JsonObject> {
    return this.http.put<JsonObject>(`${this.appService.baseUrl}${url}`, data);
  }

  delete(url: string):Observable<JsonObject> {
    return this.http.delete<JsonObject>(`${this.appService.baseUrl}${url}`);
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