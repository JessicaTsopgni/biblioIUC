import { Injectable } from '@angular/core';
import { Title } from '@angular/platform-browser';


@Injectable({
  providedIn: 'root'
})
export class AppSettings {

  readonly appName:string = 'MyBiblio';
  readonly baseUrl:string = 'http://localhost:81/biblioIUC/services';
  readonly baseMediaUrl:string = `${this.baseUrl}/medias`;

  constructor(private pageTitle: Title) { }

    getTilePage() {
      return this.pageTitle.getTitle();
    }

    setTitlePage(title:string) {
      return this.pageTitle.setTitle(`${title} - ${this.appName}`);
    }
}