
import { Routes } from '@angular/router';
import { HomeComponent } from './home/home.component';
import { ForumComponent } from './forum-posts/forum-posts.component';
import { DriversComponent } from './driver-list/driver-list.component';

export const routes: Routes = [  // Add 'export' here
  { path: 'home', component: HomeComponent },
  { path: 'drivers', component: DriversComponent },
  { path: 'forum', component: ForumComponent },

];
