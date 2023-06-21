import 'package:flutter/material.dart';
import 'package:flutter/widgets.dart';
import 'package:minipress_mobile/models/categorie.dart';

class CategPreview extends StatefulWidget {
  final Categorie categorie;

  const CategPreview({super.key, required this.categorie});
  @override
  State<CategPreview> createState() => _CategPreview();
}

class _CategPreview extends State<CategPreview> {
  @override
  Widget build(BuildContext context) {
    return Center(
      child: Row(
        children: [
          Text(widget.categorie.titre)
        ],
      )
    );
  }
}