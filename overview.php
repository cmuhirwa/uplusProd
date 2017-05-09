<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">

<?php include "template/header.php"?>

  <div class="page bg-white animsition">
    <!-- Media Sidebar -->
    <div class="page-aside">
      <div class="page-aside-switch">
        <i class="icon md-chevron-left" aria-hidden="true"></i>
        <i class="icon md-chevron-right" aria-hidden="true"></i>
      </div>
      <div class="page-aside-inner" data-plugin="pageAsideScroll">
        <div data-role="container">
          <div data-role="content">
            <section class="page-aside-section">
              <h5 class="page-aside-title">Main</h5>
              <div class="list-group">
                <a class="list-group-item active" href="javascript:void(0)"><i class="icon md-view-dashboard" aria-hidden="true"></i>Overview</a>
                <a class="list-group-item" href="javascript:void(0)"><i class="icon md-image-o" aria-hidden="true"></i>Activity</a>
                <a class="list-group-item" href="javascript:void(0)"><i class="icon md-favorite" aria-hidden="true"></i>Dearest</a>
                <a class="list-group-item" href="javascript:void(0)"><i class="icon md-folder" aria-hidden="true"></i>Folders</a>
              </div>
            </section>
            <section class="page-aside-section">
              <h5 class="page-aside-title">Filter</h5>
              <div class="list-group">
                <a class="list-group-item" href="javascript:void(0)"><i class="icon md-image" aria-hidden="true"></i>Images</a>
                <a class="list-group-item" href="javascript:void(0)"><i class="icon md-volume-up" aria-hidden="true"></i>Audio</a>
                <a class="list-group-item" href="javascript:void(0)"><i class="icon md-videocam" aria-hidden="true"></i>Video</a>
                <a class="list-group-item" href="javascript:void(0)"><i class="icon md-file" aria-hidden="true"></i>Notes</a>
                <a class="list-group-item" href="javascript:void(0)"><i class="icon md-link" aria-hidden="true"></i>Links</a>
                <a class="list-group-item" href="javascript:void(0)"><i class="icon md-receipt" aria-hidden="true"></i>Files</a>
              </div>
            </section>
          </div>
        </div>
      </div>
    </div>

    <!-- Media Content -->
    <div class="page-main">

      <!-- Media Content Header -->
      <div class="page-header">
        <h1 class="page-title">Overview</h1>
        <div class="page-header-actions">
          <form>
            <div class="input-search input-search-dark">
              <i class="input-search-icon md-search" aria-hidden="true"></i>
              <input type="text" class="form-control" name="" placeholder="Search...">
            </div>
          </form>
        </div>
      </div>

      <!-- Media Content -->
      <div class="page-content page-content-table" data-selectable="selectable">

        <!-- Actions -->
        <div class="page-content-actions">
          <div class="pull-right">
            <div class="btn-group media-arrangement" role="group">
              <button class="btn btn-default active" id="arrangement-grid" type="button"><i class="icon md-view-module" aria-hidden="true"></i></button>
              <button class="btn btn-default" id="arrangement-list" type="button"><i class="icon md-view-list" aria-hidden="true"></i></button>
            </div>
          </div>
          <div class="actions-inner">
            <div class="checkbox-custom checkbox-primary checkbox-lg">
              <input type="checkbox" id="media_all" class="selectable-all">
              <label for="media_all"></label>
            </div>
          </div>
        </div>

        <!-- Media -->
        <div class="media-list is-grid padding-bottom-50">
          <ul class="blocks blocks-100 blocks-xlg-4 blocks-lg-3 blocks-md-3 blocks-ms-2 blocks-xs-2"
          data-plugin="animateList" data-child=">li">
            <li>
              <div class="media-item" data-toggle="slidePanel" data-url="panel.tpl">
                <div class="checkbox-custom checkbox-primary checkbox-lg">
                  <input type="checkbox" class="selectable-item" id="media_1" />
                  <label for="media_1"></label>
                </div>
                <div class="image-wrap">
                  <img class="image img-rounded" src="assets/global/photos/view-1-960x640.jpg"
                  alt="...">
                </div>
                <div class="info-wrap">
                  <div class="dropdown">
                    <span class="icon md-settings dropdown-toggle" role="button" data-toggle="dropdown"
                    data-animation="scale-up"></span>
                    <ul class="dropdown-menu dropdown-menu-right" role="menu">
                      <li><a href="javascript:void(0)"><i class="icon md-edit" aria-hidden="true"></i>Edit</a></li>
                      <li><a href="javascript:void(0)"><i class="icon md-download" aria-hidden="true"></i>Download</a></li>
                      <li><a href="javascript:void(0)"><i class="icon md-delete" aria-hidden="true"></i>Delete</a></li>
                    </ul>
                  </div>
                  <div class="title">Lorem ipsum</div>
                  <div class="time">1 minutes ago</div>
                  <div class="media-item-actions btn-group">
                    <button class="btn btn-icon btn-pure btn-default" data-original-title="Edit" data-toggle="tooltip"
                    data-container="body" data-placement="top" data-trigger="hover"
                    type="button">
                      <i class="icon md-edit" aria-hidden="true"></i>
                    </button>
                    <button class="btn btn-icon btn-pure btn-default" data-original-title="Download"
                    data-toggle="tooltip" data-container="body" data-placement="top"
                    data-trigger="hover" type="button">
                      <i class="icon md-download" aria-hidden="true"></i>
                    </button>
                    <button class="btn btn-icon btn-pure btn-default" data-original-title="Delete"
                    data-toggle="tooltip" data-container="body" data-placement="top"
                    data-trigger="hover" type="button">
                      <i class="icon md-delete" aria-hidden="true"></i>
                    </button>
                  </div>
                </div>
              </div>
            </li>
            <li>
              <div class="media-item" data-toggle="slidePanel" data-url="panel.tpl">
                <div class="checkbox-custom checkbox-primary checkbox-lg">
                  <input type="checkbox" class="selectable-item" id="media_2" />
                  <label for="media_2"></label>
                </div>
                <div class="image-wrap">
                  <img class="image img-rounded" src="assets/global/photos/view-2-960x640.jpg"
                  alt="...">
                </div>
                <div class="info-wrap">
                  <div class="dropdown">
                    <span class="icon md-settings dropdown-toggle" role="button" data-toggle="dropdown"
                    data-animation="scale-up"></span>
                    <ul class="dropdown-menu dropdown-menu-right" role="menu">
                      <li><a href="javascript:void(0)"><i class="icon md-edit" aria-hidden="true"></i>Edit</a></li>
                      <li><a href="javascript:void(0)"><i class="icon md-download" aria-hidden="true"></i>Download</a></li>
                      <li><a href="javascript:void(0)"><i class="icon md-delete" aria-hidden="true"></i>Delete</a></li>
                    </ul>
                  </div>
                  <div class="title">Voluptate pariatur</div>
                  <div class="time">20 minutes ago</div>
                  <div class="media-item-actions btn-group">
                    <button class="btn btn-icon btn-pure btn-default" data-original-title="Edit" data-toggle="tooltip"
                    data-container="body" data-placement="top" data-trigger="hover"
                    type="button">
                      <i class="icon md-edit" aria-hidden="true"></i>
                    </button>
                    <button class="btn btn-icon btn-pure btn-default" data-original-title="Download"
                    data-toggle="tooltip" data-container="body" data-placement="top"
                    data-trigger="hover" type="button">
                      <i class="icon md-download" aria-hidden="true"></i>
                    </button>
                    <button class="btn btn-icon btn-pure btn-default" data-original-title="Delete"
                    data-toggle="tooltip" data-container="body" data-placement="top"
                    data-trigger="hover" type="button">
                      <i class="icon md-delete" aria-hidden="true"></i>
                    </button>
                  </div>
                </div>
              </div>
            </li>
            <li>
              <div class="media-item" data-toggle="slidePanel" data-url="panel.tpl">
                <div class="checkbox-custom checkbox-primary checkbox-lg">
                  <input type="checkbox" class="selectable-item" id="media_3" />
                  <label for="media_3"></label>
                </div>
                <div class="image-wrap">
                  <img class="image img-rounded" src="assets/global/photos/view-3-960x640.jpg"
                  alt="...">
                </div>
                <div class="info-wrap">
                  <div class="dropdown">
                    <span class="icon md-settings dropdown-toggle" role="button" data-toggle="dropdown"
                    data-animation="scale-up"></span>
                    <ul class="dropdown-menu dropdown-menu-right" role="menu">
                      <li><a href="javascript:void(0)"><i class="icon md-edit" aria-hidden="true"></i>Edit</a></li>
                      <li><a href="javascript:void(0)"><i class="icon md-download" aria-hidden="true"></i>Download</a></li>
                      <li><a href="javascript:void(0)"><i class="icon md-delete" aria-hidden="true"></i>Delete</a></li>
                    </ul>
                  </div>
                  <div class="title">Laboris Excepteur</div>
                  <div class="time">1 hour ago</div>
                  <div class="media-item-actions btn-group">
                    <button class="btn btn-icon btn-pure btn-default" data-original-title="Edit" data-toggle="tooltip"
                    data-container="body" data-placement="top" data-trigger="hover"
                    type="button">
                      <i class="icon md-edit" aria-hidden="true"></i>
                    </button>
                    <button class="btn btn-icon btn-pure btn-default" data-original-title="Download"
                    data-toggle="tooltip" data-container="body" data-placement="top"
                    data-trigger="hover" type="button">
                      <i class="icon md-download" aria-hidden="true"></i>
                    </button>
                    <button class="btn btn-icon btn-pure btn-default" data-original-title="Delete"
                    data-toggle="tooltip" data-container="body" data-placement="top"
                    data-trigger="hover" type="button">
                      <i class="icon md-delete" aria-hidden="true"></i>
                    </button>
                  </div>
                </div>
              </div>
            </li>
            <li>
              <div class="media-item" data-toggle="slidePanel" data-url="panel.tpl">
                <div class="checkbox-custom checkbox-primary checkbox-lg">
                  <input type="checkbox" class="selectable-item" id="media_4" />
                  <label for="media_4"></label>
                </div>
                <div class="image-wrap">
                  <img class="image img-rounded" src="assets/global/photos/view-4-960x640.jpg"
                  alt="...">
                </div>
                <div class="info-wrap">
                  <div class="dropdown">
                    <span class="icon md-settings dropdown-toggle" role="button" data-toggle="dropdown"
                    data-animation="scale-up"></span>
                    <ul class="dropdown-menu dropdown-menu-right" role="menu">
                      <li><a href="javascript:void(0)"><i class="icon md-edit" aria-hidden="true"></i>Edit</a></li>
                      <li><a href="javascript:void(0)"><i class="icon md-download" aria-hidden="true"></i>Download</a></li>
                      <li><a href="javascript:void(0)"><i class="icon md-delete" aria-hidden="true"></i>Delete</a></li>
                    </ul>
                  </div>
                  <div class="title">Consequat ullamco</div>
                  <div class="time">3 hours ago</div>
                  <div class="media-item-actions btn-group">
                    <button class="btn btn-icon btn-pure btn-default" data-original-title="Edit" data-toggle="tooltip"
                    data-container="body" data-placement="top" data-trigger="hover"
                    type="button">
                      <i class="icon md-edit" aria-hidden="true"></i>
                    </button>
                    <button class="btn btn-icon btn-pure btn-default" data-original-title="Download"
                    data-toggle="tooltip" data-container="body" data-placement="top"
                    data-trigger="hover" type="button">
                      <i class="icon md-download" aria-hidden="true"></i>
                    </button>
                    <button class="btn btn-icon btn-pure btn-default" data-original-title="Delete"
                    data-toggle="tooltip" data-container="body" data-placement="top"
                    data-trigger="hover" type="button">
                      <i class="icon md-delete" aria-hidden="true"></i>
                    </button>
                  </div>
                </div>
              </div>
            </li>
            <li>
              <div class="media-item" data-toggle="slidePanel" data-url="panel.tpl">
                <div class="checkbox-custom checkbox-primary checkbox-lg">
                  <input type="checkbox" class="selectable-item" id="media_5" />
                  <label for="media_5"></label>
                </div>
                <div class="image-wrap">
                  <img class="image img-rounded" src="assets/global/photos/view-5-960x640.jpg"
                  alt="...">
                </div>
                <div class="info-wrap">
                  <div class="dropdown">
                    <span class="icon md-settings dropdown-toggle" role="button" data-toggle="dropdown"
                    data-animation="scale-up"></span>
                    <ul class="dropdown-menu dropdown-menu-right" role="menu">
                      <li><a href="javascript:void(0)"><i class="icon md-edit" aria-hidden="true"></i>Edit</a></li>
                      <li><a href="javascript:void(0)"><i class="icon md-download" aria-hidden="true"></i>Download</a></li>
                      <li><a href="javascript:void(0)"><i class="icon md-delete" aria-hidden="true"></i>Delete</a></li>
                    </ul>
                  </div>
                  <div class="title">Eiusmod amet</div>
                  <div class="time">7 hours ago</div>
                  <div class="media-item-actions btn-group">
                    <button class="btn btn-icon btn-pure btn-default" data-original-title="Edit" data-toggle="tooltip"
                    data-container="body" data-placement="top" data-trigger="hover"
                    type="button">
                      <i class="icon md-edit" aria-hidden="true"></i>
                    </button>
                    <button class="btn btn-icon btn-pure btn-default" data-original-title="Download"
                    data-toggle="tooltip" data-container="body" data-placement="top"
                    data-trigger="hover" type="button">
                      <i class="icon md-download" aria-hidden="true"></i>
                    </button>
                    <button class="btn btn-icon btn-pure btn-default" data-original-title="Delete"
                    data-toggle="tooltip" data-container="body" data-placement="top"
                    data-trigger="hover" type="button">
                      <i class="icon md-delete" aria-hidden="true"></i>
                    </button>
                  </div>
                </div>
              </div>
            </li>
            <li>
              <div class="media-item" data-toggle="slidePanel" data-url="panel.tpl">
                <div class="checkbox-custom checkbox-primary checkbox-lg">
                  <input type="checkbox" class="selectable-item" id="media_6" />
                  <label for="media_6"></label>
                </div>
                <div class="image-wrap">
                  <img class="image img-rounded" src="assets/global/photos/view-6-960x640.jpg"
                  alt="...">
                </div>
                <div class="info-wrap">
                  <div class="dropdown">
                    <span class="icon md-settings dropdown-toggle" role="button" data-toggle="dropdown"
                    data-animation="scale-up"></span>
                    <ul class="dropdown-menu dropdown-menu-right" role="menu">
                      <li><a href="javascript:void(0)"><i class="icon md-edit" aria-hidden="true"></i>Edit</a></li>
                      <li><a href="javascript:void(0)"><i class="icon md-download" aria-hidden="true"></i>Download</a></li>
                      <li><a href="javascript:void(0)"><i class="icon md-delete" aria-hidden="true"></i>Delete</a></li>
                    </ul>
                  </div>
                  <div class="title">ullamco quis</div>
                  <div class="time">16 hours ago</div>
                  <div class="media-item-actions btn-group">
                    <button class="btn btn-icon btn-pure btn-default" data-original-title="Edit" data-toggle="tooltip"
                    data-container="body" data-placement="top" data-trigger="hover"
                    type="button">
                      <i class="icon md-edit" aria-hidden="true"></i>
                    </button>
                    <button class="btn btn-icon btn-pure btn-default" data-original-title="Download"
                    data-toggle="tooltip" data-container="body" data-placement="top"
                    data-trigger="hover" type="button">
                      <i class="icon md-download" aria-hidden="true"></i>
                    </button>
                    <button class="btn btn-icon btn-pure btn-default" data-original-title="Delete"
                    data-toggle="tooltip" data-container="body" data-placement="top"
                    data-trigger="hover" type="button">
                      <i class="icon md-delete" aria-hidden="true"></i>
                    </button>
                  </div>
                </div>
              </div>
            </li>
            <li>
              <div class="media-item" data-toggle="slidePanel" data-url="panel.tpl">
                <div class="checkbox-custom checkbox-primary checkbox-lg">
                  <input type="checkbox" class="selectable-item" id="media_7" />
                  <label for="media_7"></label>
                </div>
                <div class="image-wrap">
                  <img class="image img-rounded" src="assets/global/photos/view-7-960x640.jpg"
                  alt="...">
                </div>
                <div class="info-wrap">
                  <div class="dropdown">
                    <span class="icon md-settings dropdown-toggle" role="button" data-toggle="dropdown"
                    data-animation="scale-up"></span>
                    <ul class="dropdown-menu dropdown-menu-right" role="menu">
                      <li><a href="javascript:void(0)"><i class="icon md-edit" aria-hidden="true"></i>Edit</a></li>
                      <li><a href="javascript:void(0)"><i class="icon md-download" aria-hidden="true"></i>Download</a></li>
                      <li><a href="javascript:void(0)"><i class="icon md-delete" aria-hidden="true"></i>Delete</a></li>
                    </ul>
                  </div>
                  <div class="title">Reprehenderit</div>
                  <div class="time">1 day ago</div>
                  <div class="media-item-actions btn-group">
                    <button class="btn btn-icon btn-pure btn-default" data-original-title="Edit" data-toggle="tooltip"
                    data-container="body" data-placement="top" data-trigger="hover"
                    type="button">
                      <i class="icon md-edit" aria-hidden="true"></i>
                    </button>
                    <button class="btn btn-icon btn-pure btn-default" data-original-title="Download"
                    data-toggle="tooltip" data-container="body" data-placement="top"
                    data-trigger="hover" type="button">
                      <i class="icon md-download" aria-hidden="true"></i>
                    </button>
                    <button class="btn btn-icon btn-pure btn-default" data-original-title="Delete"
                    data-toggle="tooltip" data-container="body" data-placement="top"
                    data-trigger="hover" type="button">
                      <i class="icon md-delete" aria-hidden="true"></i>
                    </button>
                  </div>
                </div>
              </div>
            </li>
            <li>
              <div class="media-item" data-toggle="slidePanel" data-url="panel.tpl">
                <div class="checkbox-custom checkbox-primary checkbox-lg">
                  <input type="checkbox" class="selectable-item" id="media_8" />
                  <label for="media_8"></label>
                </div>
                <div class="image-wrap">
                  <img class="image img-rounded" src="assets/global/photos/view-8-960x640.jpg"
                  alt="...">
                </div>
                <div class="info-wrap">
                  <div class="dropdown">
                    <span class="icon md-settings dropdown-toggle" role="button" data-toggle="dropdown"
                    data-animation="scale-up"></span>
                    <ul class="dropdown-menu dropdown-menu-right" role="menu">
                      <li><a href="javascript:void(0)"><i class="icon md-edit" aria-hidden="true"></i>Edit</a></li>
                      <li><a href="javascript:void(0)"><i class="icon md-download" aria-hidden="true"></i>Download</a></li>
                      <li><a href="javascript:void(0)"><i class="icon md-delete" aria-hidden="true"></i>Delete</a></li>
                    </ul>
                  </div>
                  <div class="title">Ullamco fugiat</div>
                  <div class="time">2 days ago</div>
                  <div class="media-item-actions btn-group">
                    <button class="btn btn-icon btn-pure btn-default" data-original-title="Edit" data-toggle="tooltip"
                    data-container="body" data-placement="top" data-trigger="hover"
                    type="button">
                      <i class="icon md-edit" aria-hidden="true"></i>
                    </button>
                    <button class="btn btn-icon btn-pure btn-default" data-original-title="Download"
                    data-toggle="tooltip" data-container="body" data-placement="top"
                    data-trigger="hover" type="button">
                      <i class="icon md-download" aria-hidden="true"></i>
                    </button>
                    <button class="btn btn-icon btn-pure btn-default" data-original-title="Delete"
                    data-toggle="tooltip" data-container="body" data-placement="top"
                    data-trigger="hover" type="button">
                      <i class="icon md-delete" aria-hidden="true"></i>
                    </button>
                  </div>
                </div>
              </div>
            </li>
            <li>
              <div class="media-item" data-toggle="slidePanel" data-url="panel.tpl">
                <div class="checkbox-custom checkbox-primary checkbox-lg">
                  <input type="checkbox" class="selectable-item" id="media_9" />
                  <label for="media_9"></label>
                </div>
                <div class="image-wrap">
                  <img class="image img-rounded" src="assets/global/photos/view-9-960x640.jpg"
                  alt="...">
                </div>
                <div class="info-wrap">
                  <div class="dropdown">
                    <span class="icon md-settings dropdown-toggle" role="button" data-toggle="dropdown"
                    data-animation="scale-up"></span>
                    <ul class="dropdown-menu dropdown-menu-right" role="menu">
                      <li><a href="javascript:void(0)"><i class="icon md-edit" aria-hidden="true"></i>Edit</a></li>
                      <li><a href="javascript:void(0)"><i class="icon md-download" aria-hidden="true"></i>Download</a></li>
                      <li><a href="javascript:void(0)"><i class="icon md-delete" aria-hidden="true"></i>Delete</a></li>
                    </ul>
                  </div>
                  <div class="title">Dolor veniam</div>
                  <div class="time">3 days ago</div>
                  <div class="media-item-actions btn-group">
                    <button class="btn btn-icon btn-pure btn-default" data-original-title="Edit" data-toggle="tooltip"
                    data-container="body" data-placement="top" data-trigger="hover"
                    type="button">
                      <i class="icon md-edit" aria-hidden="true"></i>
                    </button>
                    <button class="btn btn-icon btn-pure btn-default" data-original-title="Download"
                    data-toggle="tooltip" data-container="body" data-placement="top"
                    data-trigger="hover" type="button">
                      <i class="icon md-download" aria-hidden="true"></i>
                    </button>
                    <button class="btn btn-icon btn-pure btn-default" data-original-title="Delete"
                    data-toggle="tooltip" data-container="body" data-placement="top"
                    data-trigger="hover" type="button">
                      <i class="icon md-delete" aria-hidden="true"></i>
                    </button>
                  </div>
                </div>
              </div>
            </li>
            <li>
              <div class="media-item" data-toggle="slidePanel" data-url="panel.tpl">
                <div class="checkbox-custom checkbox-primary checkbox-lg">
                  <input type="checkbox" class="selectable-item" id="media_10" />
                  <label for="media_10"></label>
                </div>
                <div class="image-wrap">
                  <img class="image img-rounded" src="assets/global/photos/view-10-960x640.jpg"
                  alt="...">
                </div>
                <div class="info-wrap">
                  <div class="dropdown">
                    <span class="icon md-settings dropdown-toggle" role="button" data-toggle="dropdown"
                    data-animation="scale-up"></span>
                    <ul class="dropdown-menu dropdown-menu-right" role="menu">
                      <li><a href="javascript:void(0)"><i class="icon md-edit" aria-hidden="true"></i>Edit</a></li>
                      <li><a href="javascript:void(0)"><i class="icon md-download" aria-hidden="true"></i>Download</a></li>
                      <li><a href="javascript:void(0)"><i class="icon md-delete" aria-hidden="true"></i>Delete</a></li>
                    </ul>
                  </div>
                  <div class="title">Minim officia</div>
                  <div class="time">7 days ago</div>
                  <div class="media-item-actions btn-group">
                    <button class="btn btn-icon btn-pure btn-default" data-original-title="Edit" data-toggle="tooltip"
                    data-container="body" data-placement="top" data-trigger="hover"
                    type="button">
                      <i class="icon md-edit" aria-hidden="true"></i>
                    </button>
                    <button class="btn btn-icon btn-pure btn-default" data-original-title="Download"
                    data-toggle="tooltip" data-container="body" data-placement="top"
                    data-trigger="hover" type="button">
                      <i class="icon md-download" aria-hidden="true"></i>
                    </button>
                    <button class="btn btn-icon btn-pure btn-default" data-original-title="Delete"
                    data-toggle="tooltip" data-container="body" data-placement="top"
                    data-trigger="hover" type="button">
                      <i class="icon md-delete" aria-hidden="true"></i>
                    </button>
                  </div>
                </div>
              </div>
            </li>
            <li>
              <div class="media-item" data-toggle="slidePanel" data-url="panel.tpl">
                <div class="checkbox-custom checkbox-primary checkbox-lg">
                  <input type="checkbox" class="selectable-item" id="media_11" />
                  <label for="media_11"></label>
                </div>
                <div class="image-wrap">
                  <img class="image img-rounded" src="assets/global/photos/view-11-960x640.jpg"
                  alt="...">
                </div>
                <div class="info-wrap">
                  <div class="dropdown">
                    <span class="icon md-settings dropdown-toggle" role="button" data-toggle="dropdown"
                    data-animation="scale-up"></span>
                    <ul class="dropdown-menu dropdown-menu-right" role="menu">
                      <li><a href="javascript:void(0)"><i class="icon md-edit" aria-hidden="true"></i>Edit</a></li>
                      <li><a href="javascript:void(0)"><i class="icon md-download" aria-hidden="true"></i>Download</a></li>
                      <li><a href="javascript:void(0)"><i class="icon md-delete" aria-hidden="true"></i>Delete</a></li>
                    </ul>
                  </div>
                  <div class="title">cupidatat fugiat</div>
                  <div class="time">1 week ago</div>
                  <div class="media-item-actions btn-group">
                    <button class="btn btn-icon btn-pure btn-default" data-original-title="Edit" data-toggle="tooltip"
                    data-container="body" data-placement="top" data-trigger="hover"
                    type="button">
                      <i class="icon md-edit" aria-hidden="true"></i>
                    </button>
                    <button class="btn btn-icon btn-pure btn-default" data-original-title="Download"
                    data-toggle="tooltip" data-container="body" data-placement="top"
                    data-trigger="hover" type="button">
                      <i class="icon md-download" aria-hidden="true"></i>
                    </button>
                    <button class="btn btn-icon btn-pure btn-default" data-original-title="Delete"
                    data-toggle="tooltip" data-container="body" data-placement="top"
                    data-trigger="hover" type="button">
                      <i class="icon md-delete" aria-hidden="true"></i>
                    </button>
                  </div>
                </div>
              </div>
            </li>
            <li>
              <div class="media-item" data-toggle="slidePanel" data-url="panel.tpl">
                <div class="checkbox-custom checkbox-primary checkbox-lg">
                  <input type="checkbox" class="selectable-item" id="media_12" />
                  <label for="media_12"></label>
                </div>
                <div class="image-wrap">
                  <img class="image img-rounded" src="assets/global/photos/view-12-960x640.jpg"
                  alt="...">
                </div>
                <div class="info-wrap">
                  <div class="dropdown">
                    <span class="icon md-settings dropdown-toggle" role="button" data-toggle="dropdown"
                    data-animation="scale-up"></span>
                    <ul class="dropdown-menu dropdown-menu-right" role="menu">
                      <li><a href="javascript:void(0)"><i class="icon md-edit" aria-hidden="true"></i>Edit</a></li>
                      <li><a href="javascript:void(0)"><i class="icon md-download" aria-hidden="true"></i>Download</a></li>
                      <li><a href="javascript:void(0)"><i class="icon md-delete" aria-hidden="true"></i>Delete</a></li>
                    </ul>
                  </div>
                  <div class="title">Fugiat nisi</div>
                  <div class="time">2 weeks ago</div>
                  <div class="media-item-actions btn-group">
                    <button class="btn btn-icon btn-pure btn-default" data-original-title="Edit" data-toggle="tooltip"
                    data-container="body" data-placement="top" data-trigger="hover"
                    type="button">
                      <i class="icon md-edit" aria-hidden="true"></i>
                    </button>
                    <button class="btn btn-icon btn-pure btn-default" data-original-title="Download"
                    data-toggle="tooltip" data-container="body" data-placement="top"
                    data-trigger="hover" type="button">
                      <i class="icon md-download" aria-hidden="true"></i>
                    </button>
                    <button class="btn btn-icon btn-pure btn-default" data-original-title="Delete"
                    data-toggle="tooltip" data-container="body" data-placement="top"
                    data-trigger="hover" type="button">
                      <i class="icon md-delete" aria-hidden="true"></i>
                    </button>
                  </div>
                </div>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>


  <div class="site-action">
    <button type="button" class="site-action-toggle btn-raised btn btn-success btn-floating">
      <i class="front-icon md-upload animation-scale-up" aria-hidden="true"></i>
      <i class="back-icon md-close animation-scale-up" aria-hidden="true"></i>
    </button>
    <div class="site-action-buttons">
      <button type="button" data-action="download" class="btn-raised btn btn-success btn-floating animation-slide-bottom">
        <i class="icon md-download" aria-hidden="true"></i>
      </button>
      <button type="button" data-action="trash" class="btn-raised btn btn-success btn-floating animation-slide-bottom">
        <i class="icon md-delete" aria-hidden="true"></i>
      </button>
    </div>
    <input type="file" id="fileupload" name="upload" />
  </div>


  <!-- Footer -->
  <footer class="site-footer">
    <div class="site-footer-legal">© 2016 <a href="http://themeforest.net/item/remark-responsive-bootstrap-admin-template/11989202">Remark</a></div>
    <div class="site-footer-right">
      Crafted with <i class="red-600 icon md-favorite"></i> by <a href="http://themeforest.net/user/amazingSurge">amazingSurge</a>
    </div>
  </footer>
  <!-- Core  -->
  <script src="assets/global/vendor/jquery/jquery.min.js"></script>
  <script src="assets/global/vendor/bootstrap/bootstrap.min.js"></script>
  <script src="assets/global/vendor/animsition/animsition.min.js"></script>
  <script src="assets/global/vendor/asscroll/jquery-asScroll.min.js"></script>
  <script src="assets/global/vendor/mousewheel/jquery.mousewheel.min.js"></script>
  <script src="assets/global/vendor/asscrollable/jquery.asScrollable.all.min.js"></script>
  <script src="assets/global/vendor/ashoverscroll/jquery-asHoverScroll.min.js"></script>
  <script src="assets/global/vendor/waves/waves.min.js"></script>

  <!-- Plugins -->
  <script src="assets/global/vendor/switchery/switchery.min.js"></script>
  <script src="assets/global/vendor/intro-js/intro.min.js"></script>
  <script src="assets/global/vendor/screenfull/screenfull.min.js"></script>
  <script src="assets/global/vendor/slidepanel/jquery-slidePanel.min.js"></script>

  <!-- Scripts -->
  <script src="assets/global/js/core.min.js"></script>
  <script src="assets/js/site.min.js"></script>

  <script src="assets/js/sections/menu.min.js"></script>
  <script src="assets/js/sections/menubar.min.js"></script>
  <script src="assets/js/sections/sidebar.min.js"></script>

  <script src="assets/global/js/configs/config-colors.min.js"></script>
  <script src="assets/js/configs/config-tour.min.js"></script>

  <script src="assets/global/js/components/asscrollable.min.js"></script>
  <script src="assets/global/js/components/animsition.min.js"></script>
  <script src="assets/global/js/components/slidepanel.min.js"></script>
  <script src="assets/global/js/components/switchery.min.js"></script>
  <script src="assets/global/js/components/tabs.min.js"></script>

  <script src="assets/global/js/plugins/sticky-header.min.js"></script>
  <script src="assets/global/js/components/asscrollable.min.js"></script>
  <script src="assets/global/js/components/animate-list.min.js"></script>
  <script src="assets/global/js/plugins/action-btn.min.js"></script>
  <script src="assets/global/js/plugins/selectable.min.js"></script>
  <script src="assets/global/js/components/selectable.min.js"></script>


  <script src="assets/js/app.min.js"></script>

  <script src="assets/examples/js/apps/media.min.js"></script>


  <!-- Google Analytics -->
  <script>
    (function(i, s, o, g, r, a, m) {
      i['GoogleAnalyticsObject'] = r;
      i[r] = i[r] || function() {
        (i[r].q = i[r].q || []).push(arguments)
      }, i[r].l = 1 * new Date();
      a = s.createElement(o),
        m = s.getElementsByTagName(o)[0];
      a.async = 1;
      a.src = g;
      m.parentNode.insertBefore(a, m)
    })(window, document, 'script', '../../../../../../www.google-analytics.com/analytics.js',
      'ga');

    ga('create', 'UA-65522665-1', 'auto');
    ga('send', 'pageview');
  </script>
</body>


<!-- Mirrored from getbootstrapadmin.com/remark/material/iconbar/apps/media/overview.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 18 Nov 2016 14:15:00 GMT -->
</html>