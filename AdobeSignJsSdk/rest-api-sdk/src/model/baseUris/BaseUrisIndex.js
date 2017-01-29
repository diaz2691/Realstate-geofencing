/*
*  Copyright 2016 Adobe Systems Incorporated. All rights reserved.
*  This file is licensed to you under the Apache License, Version 2.0 (the "License");
*  you may not use this file except in compliance with the License. You may obtain a copy
*  of the License at http://www.apache.org/licenses/LICENSE-2.0
*
*  Unless required by applicable law or agreed to in writing, software distributed under
*  the License is distributed on an "AS IS" BASIS, WITHOUT WARRANTIES OR REPRESENTATIONS
*  OF ANY KIND, either express or implied. See the License for the specific language
*  governing permissions and limitations under the License.
*
*/

(function(factory) {
    // CommonJS-like environments that support module.exports, like Node.
    module.exports = factory(require('../../utils/ApiClient'), require('../../model/baseUris/BaseUriInfo'));

}(function(ApiClient, BaseUriInfo) {
  'use strict';

  /**
   * @module BaseUrisIndex
   * @version 1.1.0
   */
  var BaseUrisIndex = {
    /**
     * The ApiClient constructor.
     * @property {module:ApiClient}
     */
    ApiClient: ApiClient,
    /**
     * The BaseUriInfo model constructor.
     * @property {module:model/baseUris/BaseUriInfo}
     */
    BaseUriInfo: BaseUriInfo
  };

  return BaseUrisIndex ;
}));
