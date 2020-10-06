import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { CategoryListComponent } from './components/category-list/category-list.component';
import { CategoryNewComponent } from './components/category-new/category-new.component';


const routes: Routes = [
  { path: '', component: CategoryListComponent },
  { path: 'category/new', component: CategoryNewComponent }
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
