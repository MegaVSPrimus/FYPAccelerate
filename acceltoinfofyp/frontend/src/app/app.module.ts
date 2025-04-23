import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { RouterModule } from '@angular/router';
import { AppComponent } from './app.component';
import { routes } from './app.routes';
import { DriversComponent } from './driver-list/driver-list.component';

@NgModule({
  declarations: [
    AppComponent,
    DriversComponent
  ],
  imports: [
    BrowserModule,
    RouterModule.forRoot(routes) // Use RouterModule with routes
  ],
  bootstrap: [AppComponent]
})
export class AppModule { }
